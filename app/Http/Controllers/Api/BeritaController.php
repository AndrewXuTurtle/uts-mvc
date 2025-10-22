<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::query();

        // Filter berita biasa (exclude prestasi)
        if ($request->has('exclude_prestasi') && $request->exclude_prestasi) {
            $query->beritaBiasa();
        }

        // Filter by date range
        if ($request->has('tanggal_dari')) {
            $query->where('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai')) {
            $query->where('tanggal', '<=', $request->tanggal_sampai);
        }

        // Search by title or content
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $berita = $query->latest('tanggal')->paginate($perPage);

        // Add full image URL
        $berita->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            $data['gambar_url'] = $item->gambar ? url('storage/' . $item->gambar) : null;
            return $data;
        });

        return response()->json($berita);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'is_prestasi' => 'boolean',
            'nama_mahasiswa' => 'required_if:is_prestasi,1|nullable|string|max:255',
            'nim' => 'required_if:is_prestasi,1|nullable|string|max:50',
            'program_studi' => 'nullable|string|max:255',
            'tingkat_prestasi' => 'nullable|in:Internasional,Nasional,Regional,Lokal',
            'jenis_prestasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'tanggal_prestasi' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = Berita::uploadGambar($request->file('gambar'));
        }

        $berita = Berita::create($validated);

        $data = $berita->toArray();
        $data['gambar_url'] = $berita->gambar ? url('storage/' . $berita->gambar) : null;

        return response()->json([
            'message' => 'Berita berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $berita = Berita::find($id);
        
        if (!$berita) {
            return response()->json([
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }

        $data = $berita->toArray();
        $data['gambar_url'] = $berita->gambar ? url('storage/' . $berita->gambar) : null;

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::find($id);
        
        if (!$berita) {
            return response()->json([
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'penulis' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'is_prestasi' => 'boolean',
            'nama_mahasiswa' => 'required_if:is_prestasi,1|nullable|string|max:255',
            'nim' => 'required_if:is_prestasi,1|nullable|string|max:50',
            'program_studi' => 'nullable|string|max:255',
            'tingkat_prestasi' => 'nullable|in:Internasional,Nasional,Regional,Lokal',
            'jenis_prestasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'tanggal_prestasi' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = Berita::uploadGambar($request->file('gambar'));
        }

        $berita->update($validated);

        $data = $berita->toArray();
        $data['gambar_url'] = $berita->gambar ? url('storage/' . $berita->gambar) : null;

        return response()->json([
            'message' => 'Berita berhasil diperbarui',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::find($id);
        
        if (!$berita) {
            return response()->json([
                'message' => 'Berita tidak ditemukan'
            ], 404);
        }

        // Delete image file
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return response()->json([
            'message' => 'Berita berhasil dihapus'
        ]);
    }
}
