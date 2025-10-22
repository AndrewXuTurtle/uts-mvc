<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilProdi;
use Illuminate\Support\Facades\Storage;

class ProfilProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilProdi = ProfilProdi::all();
        return view('profil-prodi.index', compact('profilProdi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profil-prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:150',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'akreditasi' => 'nullable|string|max:10',
            'logo' => 'nullable|image|max:2048',
            'kontak_email' => 'nullable|email|max:160',
            'kontak_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('profil_prodi', 'public');
        }

        ProfilProdi::create($validated);

        return redirect()->route('profil-prodi.index')
            ->with('success', 'Data profil prodi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profilProdi = ProfilProdi::findOrFail($id);
        return view('profil-prodi.show', compact('profilProdi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profilProdi = ProfilProdi::findOrFail($id);
        return view('profil-prodi.edit', compact('profilProdi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profilProdi = ProfilProdi::findOrFail($id);

        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:150',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'akreditasi' => 'nullable|string|max:10',
            'logo' => 'nullable|image|max:2048',
            'kontak_email' => 'nullable|email|max:160',
            'kontak_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($profilProdi->logo) {
                Storage::delete('public/' . $profilProdi->logo);
            }
            $validated['logo'] = $request->file('logo')->store('profil_prodi', 'public');
        }

        $profilProdi->update($validated);

        return redirect()->route('profil-prodi.index')
            ->with('success', 'Data profil prodi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profilProdi = ProfilProdi::findOrFail($id);

        // Delete logo file
        if ($profilProdi->logo) {
            Storage::delete('public/' . $profilProdi->logo);
        }

        $profilProdi->delete();

        return redirect()->route('profil-prodi.index')
            ->with('success', 'Data profil prodi berhasil dihapus');
    }
}
