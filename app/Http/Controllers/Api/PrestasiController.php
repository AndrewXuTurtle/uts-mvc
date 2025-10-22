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
        $query = Berita::query()->prestasi();

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
                  ->orWhere('nim', 'like', "%{$search}%");
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

        // Add full image URL
        $prestasi->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            $data['gambar_url'] = $item->gambar ? url('storage/' . $item->gambar) : null;
            return $data;
        });

        return response()->json($prestasi);
    }

    /**
     * Display the specified prestasi.
     */
    public function show(string $id)
    {
        $prestasi = Berita::prestasi()->find($id);
        
        if (!$prestasi) {
            return response()->json([
                'message' => 'Prestasi tidak ditemukan'
            ], 404);
        }

        $data = $prestasi->toArray();
        $data['gambar_url'] = $prestasi->gambar ? url('storage/' . $prestasi->gambar) : null;

        return response()->json([
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
                ->latest('tanggal_prestasi')
                ->take(5)
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'judul' => $item->judul,
                        'nama_mahasiswa' => $item->nama_mahasiswa,
                        'nim' => $item->nim,
                        'tingkat_prestasi' => $item->tingkat_prestasi,
                        'tanggal_prestasi' => $item->tanggal_prestasi,
                        'gambar_url' => $item->gambar ? url('storage/' . $item->gambar) : null,
                    ];
                }),
        ];

        return response()->json($stats);
    }
}
