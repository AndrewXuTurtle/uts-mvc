<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeri = Galeri::with('kegiatan')->latest()->get();
        return view('galeri.index', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('galeri.create', compact('kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:tbl_kegiatan,id',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi',
            'tipe' => 'required|string|in:foto,video',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('galeri', $filename, 'public');
            $validated['file'] = $filename;
        }

        Galeri::create($validated);

        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::with('kegiatan')->findOrFail($id);
        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $kegiatan = Kegiatan::all();
        return view('galeri.edit', compact('galeri', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kegiatan_id' => 'required|exists:tbl_kegiatan,id',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi',
            'tipe' => 'required|string|in:foto,video',
            'keterangan' => 'nullable|string',
        ]);

        $galeri = Galeri::findOrFail($id);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($galeri->file && Storage::disk('public')->exists('galeri/' . $galeri->file)) {
                Storage::disk('public')->delete('galeri/' . $galeri->file);
            }

            // Upload new file
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('galeri', $filename, 'public');
            $validated['file'] = $filename;
        }

        $galeri->update($validated);

        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);

        // Delete file from storage
        if ($galeri->file && Storage::disk('public')->exists('galeri/' . $galeri->file)) {
            Storage::disk('public')->delete('galeri/' . $galeri->file);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}
