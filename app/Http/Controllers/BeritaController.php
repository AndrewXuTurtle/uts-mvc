<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::latest()->paginate(10);
        return view('berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('berita.create');
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

        $validated['is_prestasi'] = $request->has('is_prestasi') ? true : false;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = Berita::uploadGambar($request->file('gambar'));
        }

        Berita::create($validated);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

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

        $validated['is_prestasi'] = $request->has('is_prestasi') ? true : false;

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = Berita::uploadGambar($request->file('gambar'));
        }

        $berita->update($validated);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        // Delete image file
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
