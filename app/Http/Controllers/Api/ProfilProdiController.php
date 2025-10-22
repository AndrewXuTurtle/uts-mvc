<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        $profilProdi = ProfilProdi::all()->map(function ($item) {
            $data = $item->toArray();
            $data['logo_url'] = $item->logo ? url('storage/' . $item->logo) : null;
            return $data;
        });

        return response()->json($profilProdi);
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

        $profilProdi = ProfilProdi::create($validated);

        $data = $profilProdi->toArray();
        $data['logo_url'] = $profilProdi->logo ? url('storage/' . $profilProdi->logo) : null;

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profilProdi = ProfilProdi::find($id);
        if (!$profilProdi) {
            return response()->json(['message' => 'Profil Prodi not found'], 404);
        }

        $data = $profilProdi->toArray();
        $data['logo_url'] = $profilProdi->logo ? url('storage/' . $profilProdi->logo) : null;

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profilProdi = ProfilProdi::find($id);
        if (!$profilProdi) {
            return response()->json(['message' => 'Profil Prodi not found'], 404);
        }

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

        $data = $profilProdi->toArray();
        $data['logo_url'] = $profilProdi->logo ? url('storage/' . $profilProdi->logo) : null;

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profilProdi = ProfilProdi::find($id);
        if (!$profilProdi) {
            return response()->json(['message' => 'Profil Prodi not found'], 404);
        }

        // Delete logo file
        if ($profilProdi->logo) {
            Storage::delete('public/' . $profilProdi->logo);
        }

        $profilProdi->delete();

        return response()->json(['message' => 'Profil Prodi deleted successfully']);
    }
}
