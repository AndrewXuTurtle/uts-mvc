<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KisahSukses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KisahSuksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Eager load mahasiswa directly
        $query = KisahSukses::with('mahasiswa');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            // Default: only show published
            $query->where('status', 'Published');
        }

        // Filter by tahun_pencapaian
        if ($request->filled('tahun_pencapaian')) {
            $query->where('tahun_pencapaian', $request->tahun_pencapaian);
        }

        // Search by judul or kisah
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kisah', 'like', "%{$search}%");
            });
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('tanggal_publish', $request->year);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'tanggal_publish');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if ($sortBy === 'popular') {
            $query->orderBy('views', 'desc');
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $perPage = $request->get('per_page', 12);
        $kisahSukses = $query->paginate($perPage);

        // Transform to include alumni+mahasiswa data
        $kisahSukses->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                // Flatten alumni + mahasiswa data
                'alumni' => [
                    'nim' => $item->alumni->nim ?? null,
                    'nama' => $item->alumni->mahasiswa->nama ?? 'N/A',
                    'email' => $item->alumni->mahasiswa->email ?? null,
                    'prodi' => $item->alumni->mahasiswa->prodi ?? null,
                    'tahun_lulus' => $item->alumni->mahasiswa->tahun_lulus ?? null,
                    'foto_url' => $item->alumni->foto_alumni ? asset('storage/' . $item->alumni->foto_alumni) : null,
                    // Alumni work info
                    'nama_perusahaan' => $item->alumni->nama_perusahaan,
                    'posisi_jabatan' => $item->alumni->posisi_jabatan,
                ],
                // Kisah Sukses data
                'judul' => $item->judul,
                'cerita' => $item->cerita,
                'kategori' => $item->kategori,
                'foto_utama' => $item->foto_utama,
                'foto_utama_url' => $item->foto_utama ? asset('storage/' . $item->foto_utama) : null,
                'galeri_foto' => $item->galeri_foto ?? [],
                'galeri_foto_urls' => collect($item->galeri_foto ?? [])->map(function($foto) {
                    return asset('storage/' . $foto);
                })->toArray(),
                'video_url' => $item->video_url,
                'quote' => $item->quote,
                'tanggal_publish' => $item->tanggal_publish,
                'is_featured' => $item->is_featured,
                'status' => $item->status,
                'tags' => $item->tags ?? [],
                'views' => $item->views,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $kisahSukses,
            'message' => 'Data kisah sukses berhasil diambil'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alumni_id' => 'required|exists:alumni,id',
            'judul' => 'required|string|max:255',
            'cerita' => 'required|string',
            'kategori' => 'required|in:karir,wirausaha,prestasi,melanjutkan_studi',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri_foto' => 'nullable|array',
            'galeri_foto.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'video_url' => 'nullable|url',
            'quote' => 'nullable|string',
            'tanggal_publish' => 'required|date',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'tags' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except(['foto_utama', 'galeri_foto']);

        // Handle foto utama upload
        if ($request->hasFile('foto_utama')) {
            $data['foto_utama'] = $request->file('foto_utama')->store('kisah-sukses/foto-utama', 'public');
        }

        // Handle galeri foto upload
        if ($request->hasFile('galeri_foto')) {
            $galeriFoto = [];
            foreach ($request->file('galeri_foto') as $foto) {
                $galeriFoto[] = $foto->store('kisah-sukses/galeri', 'public');
            }
            $data['galeri_foto'] = $galeriFoto;
        }

        $kisahSukses = KisahSukses::create($data);
        $kisahSukses->load('alumni');

        return response()->json([
            'success' => true,
            'message' => 'Kisah sukses berhasil ditambahkan',
            'data' => $kisahSukses
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kisahSukses = KisahSukses::with('mahasiswa')->findOrFail($id);

        $data = [
            'id' => $kisahSukses->id,
            'nim' => $kisahSukses->nim,
            'mahasiswa' => [
                'nim' => $kisahSukses->mahasiswa->nim ?? null,
                'nama' => $kisahSukses->mahasiswa->nama ?? 'N/A',
                'email' => $kisahSukses->mahasiswa->email ?? null,
            ],
            'judul' => $kisahSukses->judul,
            'cerita' => $kisahSukses->cerita,
            'kategori' => $kisahSukses->kategori,
            'foto_utama' => $kisahSukses->foto_utama,
            'foto_utama_url' => $kisahSukses->foto_utama ? asset('storage/' . $kisahSukses->foto_utama) : null,
            'galeri_foto' => $kisahSukses->galeri_foto ?? [],
            'galeri_foto_urls' => collect($kisahSukses->galeri_foto ?? [])->map(function($foto) {
                return asset('storage/' . $foto);
            })->toArray(),
            'video_url' => $kisahSukses->video_url,
            'quote' => $kisahSukses->quote,
            'tanggal_publish' => $kisahSukses->tanggal_publish,
            'is_featured' => $kisahSukses->is_featured,
            'status' => $kisahSukses->status,
            'tags' => $kisahSukses->tags ?? [],
            'views' => $kisahSukses->views,
            'created_at' => $kisahSukses->created_at,
            'updated_at' => $kisahSukses->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Detail kisah sukses berhasil diambil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kisahSukses = KisahSukses::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'alumni_id' => 'required|exists:alumni,id',
            'judul' => 'required|string|max:255',
            'cerita' => 'required|string',
            'kategori' => 'required|in:karir,wirausaha,prestasi,melanjutkan_studi',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri_foto' => 'nullable|array',
            'galeri_foto.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'video_url' => 'nullable|url',
            'quote' => 'nullable|string',
            'tanggal_publish' => 'required|date',
            'is_featured' => 'boolean',
            'status' => 'required|in:draft,published,archived',
            'tags' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except(['foto_utama', 'galeri_foto']);

        // Handle foto utama upload
        if ($request->hasFile('foto_utama')) {
            // Delete old photo
            if ($kisahSukses->foto_utama && Storage::disk('public')->exists($kisahSukses->foto_utama)) {
                Storage::disk('public')->delete($kisahSukses->foto_utama);
            }
            $data['foto_utama'] = $request->file('foto_utama')->store('kisah-sukses/foto-utama', 'public');
        }

        // Handle galeri foto upload
        if ($request->hasFile('galeri_foto')) {
            // Delete old galeri photos
            if ($kisahSukses->galeri_foto) {
                foreach ($kisahSukses->galeri_foto as $foto) {
                    if (Storage::disk('public')->exists($foto)) {
                        Storage::disk('public')->delete($foto);
                    }
                }
            }
            $galeriFoto = [];
            foreach ($request->file('galeri_foto') as $foto) {
                $galeriFoto[] = $foto->store('kisah-sukses/galeri', 'public');
            }
            $data['galeri_foto'] = $galeriFoto;
        }

        $kisahSukses->update($data);
        $kisahSukses->load('alumni');

        return response()->json([
            'success' => true,
            'message' => 'Kisah sukses berhasil diperbarui',
            'data' => $kisahSukses
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kisahSukses = KisahSukses::findOrFail($id);

        // Delete associated files
        if ($kisahSukses->foto_utama && Storage::disk('public')->exists($kisahSukses->foto_utama)) {
            Storage::disk('public')->delete($kisahSukses->foto_utama);
        }

        if ($kisahSukses->galeri_foto) {
            foreach ($kisahSukses->galeri_foto as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }
        }

        $kisahSukses->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kisah sukses berhasil dihapus'
        ]);
    }

    /**
     * Get featured success stories
     */
    public function featured()
    {
        // Since is_featured column doesn't exist, return most recent published stories
        $kisahSukses = KisahSukses::with('mahasiswa')
            ->where('status', 'published')
            ->orderBy('tahun_pencapaian', 'desc')
            ->limit(6)
            ->get();

        $kisahSukses = $kisahSukses->map(function ($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                'mahasiswa' => [
                    'nim' => $item->nim,
                    'nama' => $item->mahasiswa->nama ?? 'N/A',
                    'prodi' => $item->mahasiswa->prodi ?? null,
                ],
                'judul' => $item->judul,
                'kisah' => $item->kisah,
                'pencapaian' => $item->pencapaian,
                'tahun_pencapaian' => $item->tahun_pencapaian,
                'foto' => $item->foto,
                'foto_url' => $item->foto ? asset('storage/' . $item->foto) : null,
                'status' => $item->status,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $kisahSukses,
            'message' => 'Featured kisah sukses berhasil diambil'
        ]);
    }

    /**
     * Get statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => KisahSukses::where('status', 'published')->count(),
            'by_year' => KisahSukses::where('status', 'published')
                ->selectRaw('tahun_pencapaian, COUNT(*) as total')
                ->groupBy('tahun_pencapaian')
                ->orderBy('tahun_pencapaian', 'desc')
                ->get()
                ->pluck('total', 'tahun_pencapaian'),
            'total_stories' => KisahSukses::count(),
            'published_count' => KisahSukses::where('status', 'published')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Statistik kisah sukses berhasil diambil'
        ]);
    }
}
