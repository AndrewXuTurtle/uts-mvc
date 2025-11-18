<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }

        // Filter hanya yang ditampilkan di home
        if ($request->filled('home') && $request->home == 'true') {
            $query->tampilkanDiHome();
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'urutan');
        $sortOrder = $request->input('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);
        
        // Secondary sort by tanggal
        if ($sortBy != 'tanggal') {
            $query->orderBy('tanggal', 'desc');
        }

        $perPage = $request->input('per_page', 12);
        $galeri = $query->paginate($perPage);

        // Transform data untuk API response
        $galeri->getCollection()->transform(function ($item) {
            $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $galeri
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori' => 'required|in:akademik,kemahasiswaan,fasilitas,kegiatan,prestasi,lainnya',
            'tanggal' => 'nullable|date',
            'fotografer' => 'nullable|string|max:255',
            'tampilkan_di_home' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $validated['tampilkan_di_home'] = $validated['tampilkan_di_home'] ?? false;
        $validated['urutan'] = $validated['urutan'] ?? 0;

        $galeri = Galeri::create($validated);
        $galeri->foto_url = $galeri->foto ? asset('storage/' . $galeri->foto) : null;

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil ditambahkan',
            'data' => $galeri
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->foto_url = $galeri->foto ? asset('storage/' . $galeri->foto) : null;

        // Get related photos
        $related = Galeri::where('kategori', $galeri->kategori)
                        ->where('id', '!=', $galeri->id)
                        ->latest('tanggal')
                        ->limit(6)
                        ->get()
                        ->map(function ($item) {
                            $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
                            return $item;
                        });

        return response()->json([
            'success' => true,
            'data' => $galeri,
            'related' => $related
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'kategori' => 'required|in:akademik,kemahasiswaan,fasilitas,kegiatan,prestasi,lainnya',
            'tanggal' => 'nullable|date',
            'fotografer' => 'nullable|string|max:255',
            'tampilkan_di_home' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($validated);
        $galeri->foto_url = $galeri->foto ? asset('storage/' . $galeri->foto) : null;

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil diupdate',
            'data' => $galeri
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        // Delete foto if exists
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto galeri berhasil dihapus'
        ]);
    }

    /**
     * Get galeri by kategori
     */
    public function byKategori($kategori)
    {
        $galeri = Galeri::kategori($kategori)
                       ->orderBy('urutan', 'asc')
                       ->orderBy('tanggal', 'desc')
                       ->get()
                       ->map(function ($item) {
                           $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
                           return $item;
                       });

        return response()->json([
            'success' => true,
            'kategori' => $kategori,
            'total' => $galeri->count(),
            'data' => $galeri
        ]);
    }
}
