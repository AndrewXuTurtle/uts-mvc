<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenda = Agenda::latest()->paginate(10);
        return view('agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'kategori' => 'required|in:seminar,workshop,rapat,acara,lainnya',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = Agenda::uploadGambar($request->file('gambar'));
        }

        Agenda::create($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agenda = Agenda::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'kategori' => 'required|in:seminar,workshop,rapat,acara,lainnya',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }
            $validated['gambar'] = Agenda::uploadGambar($request->file('gambar'));
        }

        $agenda->update($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agenda = Agenda::findOrFail($id);

        // Delete image file
        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }
}
