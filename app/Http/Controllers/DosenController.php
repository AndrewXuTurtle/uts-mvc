<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dosen = Dosen::query()
            ->search($request->search)
            ->latest()
            ->paginate(10);

        return view('dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama' => 'required',
            'email' => 'required|email|unique:dosen,email',
            'program_studi' => 'required',
            'jabatan' => 'required',
            'bidang_keahlian' => 'nullable',
            'foto' => 'nullable|image|max:2048',
            'google_scholar_link' => 'nullable|url',
            'sinta_link' => 'nullable|url',
            'scopus_link' => 'nullable|url',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = Dosen::uploadFoto($request->file('foto'));
        }

        Dosen::create($validated);

        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosen,nidn,' . $dosen->id,
            'nama' => 'required',
            'email' => 'required|email|unique:dosen,email,' . $dosen->id,
            'program_studi' => 'required',
            'jabatan' => 'required',
            'bidang_keahlian' => 'nullable',
            'foto' => 'nullable|image|max:2048',
            'google_scholar_link' => 'nullable|url',
            'sinta_link' => 'nullable|url',
            'scopus_link' => 'nullable|url',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($dosen->foto) {
                Storage::delete('public/' . $dosen->foto);
            }
            $validated['foto'] = Dosen::uploadFoto($request->file('foto'));
        }

        $dosen->update($validated);

        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->foto) {
            Storage::delete('public/' . $dosen->foto);
        }
        
        $dosen->delete();

        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil dihapus');
    }
}
