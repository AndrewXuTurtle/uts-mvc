<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $galeri = $query->orderBy('urutan', 'asc')
                        ->orderBy('tanggal', 'desc')
                        ->paginate(12);

        // Get unique kategori for filter
        $kategoriList = ['akademik', 'kemahasiswaan', 'fasilitas', 'kegiatan', 'prestasi', 'lainnya'];

        return view('galeri.index', compact('galeri', 'kategoriList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
            'kategori' => 'required|in:akademik,kemahasiswaan,fasilitas,kegiatan,prestasi,lainnya',
            'tanggal' => 'nullable|date',
            'fotografer' => 'nullable|string|max:255',
            'tampilkan_di_home' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        // Set defaults
        $validated['tampilkan_di_home'] = $request->has('tampilkan_di_home') ? true : false;
        $validated['urutan'] = $validated['urutan'] ?? 0;

        Galeri::create($validated);

        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Get related photos (same category)
        $related = Galeri::where('kategori', $galeri->kategori)
                        ->where('id', '!=', $galeri->id)
                        ->latest('tanggal')
                        ->limit(6)
                        ->get();
        
        return view('galeri.show', compact('galeri', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
            'kategori' => 'required|in:akademik,kemahasiswaan,fasilitas,kegiatan,prestasi,lainnya',
            'tanggal' => 'nullable|date',
            'fotografer' => 'nullable|string|max:255',
            'tampilkan_di_home' => 'nullable|boolean',
            'urutan' => 'nullable|integer',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $validated['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        // Set defaults
        $validated['tampilkan_di_home'] = $request->has('tampilkan_di_home') ? true : false;
        $validated['urutan'] = $validated['urutan'] ?? $galeri->urutan;

        $galeri->update($validated);

        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil diupdate!');
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

        return redirect()->route('galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}
