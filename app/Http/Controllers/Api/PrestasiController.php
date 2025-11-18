<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of prestasi mahasiswa.
     */
    public function index(Request $request)
    {
        // Eager load mahasiswa relationship for prestasi
        $query = Berita::query()->prestasi()->with('mahasiswa');

        // Filter by tingkat prestasi
        if ($request->has('tingkat_prestasi')) {
            $query->where('tingkat_prestasi', $request->tingkat_prestasi);
        }

        // Filter by jenis prestasi
        if ($request->has('jenis_prestasi')) {
            $query->where('jenis_prestasi', 'like', '%' . $request->jenis_prestasi . '%');
        }

        // Filter by program studi
        if ($request->has('program_studi')) {
            $query->where('program_studi', 'like', '%' . $request->program_studi . '%');
        }

        // Filter by NIM
        if ($request->has('nim')) {
            $query->where('nim', $request->nim);
        }

        // Search by nama mahasiswa
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by date range
        if ($request->has('tanggal_dari')) {
            $query->where('tanggal_prestasi', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai')) {
            $query->where('tanggal_prestasi', '<=', $request->tanggal_sampai);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $prestasi = $query->latest('tanggal_prestasi')->paginate($perPage);

        // Transform to include mahasiswa data
        $prestasi->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'isi' => $item->isi,
                'penulis' => $item->penulis,
                'tanggal' => $item->tanggal,
                // Mahasiswa info - prefer from relationship if exists
                'nim' => $item->nim,
                'mahasiswa' => $item->mahasiswa ? [
                    'nim' => $item->mahasiswa->nim,
                    'nama' => $item->mahasiswa->nama,
                    'email' => $item->mahasiswa->email,
                    'kelas' => $item->mahasiswa->kelas,
                    'prodi' => $item->mahasiswa->prodi,
                    'tahun_masuk' => $item->mahasiswa->tahun_masuk,
                ] : [
                    // Fallback to stored data if relationship not found
                    'nim' => $item->nim,
                    'nama' => $item->nama_mahasiswa,
                    'prodi' => $item->program_studi,
                ],
                // Prestasi specific fields
                'is_prestasi' => $item->is_prestasi,
                'tingkat_prestasi' => $item->tingkat_prestasi,
                'jenis_prestasi' => $item->jenis_prestasi,
                'penyelenggara' => $item->penyelenggara,
                'tanggal_prestasi' => $item->tanggal_prestasi,
                // Image
                'gambar' => $item->gambar,
                'gambar_url' => $item->gambar ? asset('storage/' . $item->gambar) : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $prestasi
        ]);
    }

    /**
     * Display the specified prestasi.
     */
    public function show(string $id)
    {
        $prestasi = Berita::prestasi()->with('mahasiswa')->find($id);
        
        if (!$prestasi) {
            return response()->json([
                'success' => false,
                'message' => 'Prestasi tidak ditemukan'
            ], 404);
        }

        $data = [
            'id' => $prestasi->id,
            'judul' => $prestasi->judul,
            'isi' => $prestasi->isi,
            'penulis' => $prestasi->penulis,
            'tanggal' => $prestasi->tanggal,
            // Complete mahasiswa info
            'nim' => $prestasi->nim,
            'mahasiswa' => $prestasi->mahasiswa ? [
                'nim' => $prestasi->mahasiswa->nim,
                'nama' => $prestasi->mahasiswa->nama,
                'email' => $prestasi->mahasiswa->email,
                'no_hp' => $prestasi->mahasiswa->no_hp,
                'kelas' => $prestasi->mahasiswa->kelas,
                'prodi' => $prestasi->mahasiswa->prodi,
                'tahun_masuk' => $prestasi->mahasiswa->tahun_masuk,
                'foto' => $prestasi->mahasiswa->foto,
            ] : [
                'nim' => $prestasi->nim,
                'nama' => $prestasi->nama_mahasiswa,
                'prodi' => $prestasi->program_studi,
            ],
            // Prestasi details
            'is_prestasi' => $prestasi->is_prestasi,
            'tingkat_prestasi' => $prestasi->tingkat_prestasi,
            'jenis_prestasi' => $prestasi->jenis_prestasi,
            'penyelenggara' => $prestasi->penyelenggara,
            'tanggal_prestasi' => $prestasi->tanggal_prestasi,
            // Image
            'gambar' => $prestasi->gambar,
            'gambar_url' => $prestasi->gambar ? asset('storage/' . $prestasi->gambar) : null,
            'created_at' => $prestasi->created_at,
            'updated_at' => $prestasi->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get statistics of prestasi
     */
    public function statistics()
    {
        $stats = [
            'total_prestasi' => Berita::prestasi()->count(),
            'by_tingkat' => [
                'internasional' => Berita::prestasi()->where('tingkat_prestasi', 'Internasional')->count(),
                'nasional' => Berita::prestasi()->where('tingkat_prestasi', 'Nasional')->count(),
                'regional' => Berita::prestasi()->where('tingkat_prestasi', 'Regional')->count(),
                'lokal' => Berita::prestasi()->where('tingkat_prestasi', 'Lokal')->count(),
            ],
            'prestasi_terbaru' => Berita::prestasi()
                ->with('mahasiswa')
                ->latest('tanggal_prestasi')
                ->take(5)
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'judul' => $item->judul,
                        'nim' => $item->nim,
                        'mahasiswa' => [
                            'nama' => $item->mahasiswa->nama ?? $item->nama_mahasiswa,
                            'prodi' => $item->mahasiswa->prodi ?? $item->program_studi,
                        ],
                        'tingkat_prestasi' => $item->tingkat_prestasi,
                        'jenis_prestasi' => $item->jenis_prestasi,
                        'tanggal_prestasi' => $item->tanggal_prestasi,
                        'gambar_url' => $item->gambar ? asset('storage/' . $item->gambar) : null,
                    ];
                }),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
