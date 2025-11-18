<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        // Filter by aktif status
        if ($request->has('aktif')) {
            $query->where('aktif', $request->aktif);
        }

        // Filter by prioritas
        if ($request->has('prioritas')) {
            $query->where('prioritas', $request->prioritas);
        }

        // Filter yang masih berlaku
        if ($request->has('berlaku') && $request->berlaku) {
            $query->berlaku();
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
        $pengumuman = $query->latest('created_at')->paginate($perPage);

        // Add full image URL
        $pengumuman->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            $data['gambar_url'] = $item->gambar ? url('storage/' . $item->gambar) : null;
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $pengumuman
        ]);
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
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penulis' => 'required|string|max:255',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = Pengumuman::uploadGambar($request->file('gambar'));
        }

        $pengumuman = Pengumuman::create($validated);

        $data = $pengumuman->toArray();
        $data['gambar_url'] = $pengumuman->gambar ? url('storage/' . $pengumuman->gambar) : null;

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengumuman = Pengumuman::find($id);
        
        if (!$pengumuman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengumuman tidak ditemukan'
            ], 404);
        }

        $data = $pengumuman->toArray();
        $data['gambar_url'] = $pengumuman->gambar ? url('storage/' . $pengumuman->gambar) : null;

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengumuman = Pengumuman::find($id);
        
        if (!$pengumuman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengumuman tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'penulis' => 'required|string|max:255',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $validated['gambar'] = Pengumuman::uploadGambar($request->file('gambar'));
        }

        $pengumuman->update($validated);

        $data = $pengumuman->toArray();
        $data['gambar_url'] = $pengumuman->gambar ? url('storage/' . $pengumuman->gambar) : null;

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil diperbarui',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengumuman = Pengumuman::find($id);
        
        if (!$pengumuman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengumuman tidak ditemukan'
            ], 404);
        }

        // Delete image file
        if ($pengumuman->gambar) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil dihapus'
        ]);
    }
}
