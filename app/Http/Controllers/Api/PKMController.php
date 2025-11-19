<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Eager load relationships
        $query = PKM::with(['dosen', 'mahasiswa']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_pkm', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('pencapaian', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by tahun
        if ($request->has('tahun') && !empty($request->tahun)) {
            $query->where('tahun', $request->tahun);
        }

        // Filter by dosen
        if ($request->has('dosen_id') && !empty($request->dosen_id)) {
            $query->whereHas('dosen', function($q) use ($request) {
                $q->where('dosen.id', $request->dosen_id);
            });
        }

        // Filter by mahasiswa
        if ($request->has('mahasiswa_id') && !empty($request->mahasiswa_id)) {
            $query->whereHas('mahasiswa', function($q) use ($request) {
                $q->where('mahasiswa.id', $request->mahasiswa_id);
            });
        }

        $pkm = $query->orderBy('tahun', 'desc')->orderBy('judul_pkm')->paginate(15);

        // Transform to include flattened dosen and mahasiswa data
        $pkm->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'judul_pkm' => $item->judul_pkm,
                'deskripsi' => $item->deskripsi,
                'tahun' => $item->tahun,
                'jenis_pkm' => $item->jenis_pkm,
                'status' => $item->status,
                'dana' => $item->dana,
                'pencapaian' => $item->pencapaian,
                // Flatten dosen data (array of dosen)
                'dosen' => $item->dosen->map(function($dosen) {
                    return [
                        'id' => $dosen->id,
                        'nidn' => $dosen->nidn,
                        'nama' => $dosen->nama,
                        'email' => $dosen->email,
                        'jabatan' => $dosen->jabatan,
                    ];
                }),
                // Flatten mahasiswa data (array of mahasiswa)
                'mahasiswa' => $item->mahasiswa->map(function($mhs) {
                    return [
                        'nim' => $mhs->nim,
                        'nama' => $mhs->nama,
                        'email' => $mhs->email,
                        'kelas' => $mhs->kelas,
                        'prodi' => $mhs->prodi,
                    ];
                }),
                'file_dokumen' => $item->file_dokumen,
                'file_url' => $item->file_dokumen ? asset('storage/' . $item->file_dokumen) : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $pkm,
            'message' => 'Data PKM berhasil diambil'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_id' => 'required|array|min:1',
            'dosen_id.*' => 'exists:dosen,id',
            'mahasiswa_id' => 'required|array|min:1',
            'mahasiswa_id.*' => 'exists:mahasiswa,id',
            'mitra' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:ongoing,completed,published,cancelled',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'judul', 'deskripsi', 'mitra',
            'lokasi', 'biaya', 'status', 'tahun', 'tanggal_mulai', 'tanggal_selesai'
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = PKM::uploadDokumentasi($request->file('dokumentasi'));
        }

        $pkm = PKM::create($data);

        // Sync many-to-many relationships
        $pkm->dosen()->sync($request->dosen_id);
        $pkm->mahasiswa()->sync($request->mahasiswa_id);

        return response()->json([
            'success' => true,
            'data' => $pkm->load(['dosen', 'mahasiswa']),
            'message' => 'Data PKM berhasil ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PKM $pkm)
    {
        $pkm->load(['dosen', 'mahasiswa']);

        $data = [
            'id' => $pkm->id,
            'judul_pkm' => $pkm->judul_pkm,
            'deskripsi' => $pkm->deskripsi,
            'tahun' => $pkm->tahun,
            'jenis_pkm' => $pkm->jenis_pkm,
            'status' => $pkm->status,
            'dana' => $pkm->dana,
            'pencapaian' => $pkm->pencapaian,
            // Complete dosen data
            'dosen' => $pkm->dosen->map(function($dosen) {
                return [
                    'id' => $dosen->id,
                    'nidn' => $dosen->nidn,
                    'nama' => $dosen->nama,
                    'email' => $dosen->email,
                    'jabatan' => $dosen->jabatan,
                    'bidang_keahlian' => $dosen->bidang_keahlian,
                ];
            }),
            // Complete mahasiswa data
            'mahasiswa' => $pkm->mahasiswa->map(function($mhs) {
                return [
                    'nim' => $mhs->nim,
                    'nama' => $mhs->nama,
                    'email' => $mhs->email,
                    'kelas' => $mhs->kelas,
                    'prodi' => $mhs->prodi,
                    'tahun_masuk' => $mhs->tahun_masuk,
                ];
            }),
            'file_dokumen' => $pkm->file_dokumen,
            'file_url' => $pkm->file_dokumen ? asset('storage/' . $pkm->file_dokumen) : null,
            'created_at' => $pkm->created_at,
            'updated_at' => $pkm->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Data PKM berhasil diambil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PKM $pkm)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_id' => 'required|array|min:1',
            'dosen_id.*' => 'exists:dosen,id',
            'mahasiswa_id' => 'required|array|min:1',
            'mahasiswa_id.*' => 'exists:mahasiswa,id',
            'mitra' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:ongoing,completed,published,cancelled',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'judul', 'deskripsi', 'mitra',
            'lokasi', 'biaya', 'status', 'tahun', 'tanggal_mulai', 'tanggal_selesai'
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('dokumentasi')) {
            // Delete old images if they exist
            if ($pkm->dokumentasi) {
                foreach ($pkm->dokumentasi as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            $data['dokumentasi'] = PKM::uploadDokumentasi($request->file('dokumentasi'));
        }

        $pkm->update($data);

        // Sync many-to-many relationships
        $pkm->dosen()->sync($request->dosen_id);
        $pkm->mahasiswa()->sync($request->mahasiswa_id);

        return response()->json([
            'success' => true,
            'data' => $pkm->load(['dosen', 'mahasiswa']),
            'message' => 'Data PKM berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PKM $pkm)
    {
        // Delete dokumentasi images if they exist
        if ($pkm->dokumentasi) {
            foreach ($pkm->dokumentasi as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $pkm->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data PKM berhasil dihapus'
        ]);
    }

    /**
     * Get PKM by dosen
     */
    public function byDosen($dosenId)
    {
        $pkm = PKM::with(['dosen', 'mahasiswa'])
            ->whereHas('dosen', function($query) use ($dosenId) {
                $query->where('dosen.id', $dosenId);
            })
            ->orderBy('tahun', 'desc')
            ->get();

        // Transform the data
        $pkm = $pkm->map(function($item) {
            return [
                'id' => $item->id,
                'judul_pkm' => $item->judul_pkm,
                'deskripsi' => $item->deskripsi,
                'tahun' => $item->tahun,
                'jenis_pkm' => $item->jenis_pkm,
                'status' => $item->status,
                'dana' => $item->dana,
                'pencapaian' => $item->pencapaian,
                'dosen' => $item->dosen->map(function($dosen) {
                    return [
                        'id' => $dosen->id,
                        'nidn' => $dosen->nidn,
                        'nama' => $dosen->nama,
                        'email' => $dosen->email,
                        'jabatan' => $dosen->jabatan,
                    ];
                }),
                'mahasiswa' => $item->mahasiswa->map(function($mhs) {
                    return [
                        'nim' => $mhs->nim,
                        'nama' => $mhs->nama,
                        'email' => $mhs->email,
                        'kelas' => $mhs->kelas,
                        'prodi' => $mhs->prodi,
                    ];
                }),
                'file_dokumen' => $item->file_dokumen,
                'file_url' => $item->file_dokumen ? asset('storage/' . $item->file_dokumen) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $pkm,
            'dosen_id' => $dosenId,
            'total' => $pkm->count(),
            'message' => 'Data PKM berdasarkan dosen berhasil diambil'
        ]);
    }

    /**
     * Get PKM by mahasiswa
     */
    public function byMahasiswa($mahasiswaId)
    {
        $pkm = PKM::with(['dosen', 'mahasiswa'])
            ->whereHas('mahasiswa', function($query) use ($mahasiswaId) {
                $query->where('mahasiswa.id', $mahasiswaId);
            })
            ->orderBy('tahun', 'desc')
            ->get();

        // Transform the data
        $pkm = $pkm->map(function($item) {
            return [
                'id' => $item->id,
                'judul_pkm' => $item->judul_pkm,
                'deskripsi' => $item->deskripsi,
                'tahun' => $item->tahun,
                'jenis_pkm' => $item->jenis_pkm,
                'status' => $item->status,
                'dana' => $item->dana,
                'pencapaian' => $item->pencapaian,
                'dosen' => $item->dosen->map(function($dosen) {
                    return [
                        'id' => $dosen->id,
                        'nidn' => $dosen->nidn,
                        'nama' => $dosen->nama,
                        'email' => $dosen->email,
                        'jabatan' => $dosen->jabatan,
                    ];
                }),
                'mahasiswa' => $item->mahasiswa->map(function($mhs) {
                    return [
                        'nim' => $mhs->nim,
                        'nama' => $mhs->nama,
                        'email' => $mhs->email,
                        'kelas' => $mhs->kelas,
                        'prodi' => $mhs->prodi,
                    ];
                }),
                'file_dokumen' => $item->file_dokumen,
                'file_url' => $item->file_dokumen ? asset('storage/' . $item->file_dokumen) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $pkm,
            'mahasiswa_id' => $mahasiswaId,
            'total' => $pkm->count(),
            'message' => 'Data PKM berdasarkan mahasiswa berhasil diambil'
        ]);
    }

    /**
     * Get PKM statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => PKM::count(),
            'ongoing' => PKM::where('status', 'ongoing')->count(),
            'completed' => PKM::where('status', 'completed')->count(),
            'published' => PKM::where('status', 'published')->count(),
            'cancelled' => PKM::where('status', 'cancelled')->count(),
            'by_year' => PKM::selectRaw('tahun, COUNT(*) as count')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->get(),
            'total_dana' => PKM::sum('dana'),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Statistik PKM berhasil diambil'
        ]);
    }
}
