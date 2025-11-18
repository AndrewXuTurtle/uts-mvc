<?php

namespace App\Http\Controllers;

use App\Models\KisahSukses;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KisahSuksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KisahSukses::with('mahasiswa');

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kisah', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $kisahSukses = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('kisah-sukses.index', compact('kisahSukses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Don't load all alumni - let user search by NIM first
        return view('kisah-sukses.create');
    }

    /**
     * Validate NIM and return alumni data (AJAX endpoint)
     */
    public function validateNim(Request $request)
    {
        $request->validate([
            'nim' => 'required|string'
        ]);

        $alumni = Alumni::with('mahasiswa')
            ->where('nim', $request->nim)
            ->first();

        if (!$alumni) {
            return response()->json([
                'success' => false,
                'message' => 'NIM tidak ditemukan di data alumni. Pastikan mahasiswa sudah dikonversi ke alumni.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $alumni->id,
                'nim' => $alumni->nim,
                'nama' => $alumni->mahasiswa->nama ?? 'N/A',
                'prodi' => $alumni->mahasiswa->prodi ?? 'N/A',
                'tahun_lulus' => $alumni->mahasiswa->tahun_lulus ?? 'N/A',
                'email' => $alumni->email ?? 'Belum ada email',
                'status_data' => $alumni->status_data,
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul' => 'required|max:255',
            'kisah' => 'required',
            'pencapaian' => 'required|max:255',
            'tahun_pencapaian' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Draft,Published,Archived',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kisah-sukses', 'public');
        }

        KisahSukses::create($validated);

        return redirect()->route('kisah-sukses.index')
            ->with('success', 'Kisah sukses berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kisahSukses = KisahSukses::with('mahasiswa')->findOrFail($id);
        return view('kisah-sukses.show', compact('kisahSukses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kisahSukses = KisahSukses::with('mahasiswa')->findOrFail($id);
        return view('kisah-sukses.edit', compact('kisahSukses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kisahSukses = KisahSukses::findOrFail($id);

        $validated = $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul' => 'required|max:255',
            'kisah' => 'required',
            'pencapaian' => 'required|max:255',
            'tahun_pencapaian' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Draft,Published,Archived',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($kisahSukses->foto) {
                Storage::disk('public')->delete($kisahSukses->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kisah-sukses', 'public');
        }

        $kisahSukses->update($validated);

        return redirect()->route('kisah-sukses.index')
            ->with('success', 'Kisah sukses berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kisahSukses = KisahSukses::findOrFail($id);

        // Delete foto
        if ($kisahSukses->foto) {
            Storage::disk('public')->delete($kisahSukses->foto);
        }

        $kisahSukses->delete();

        return redirect()->route('kisah-sukses.index')
            ->with('success', 'Kisah sukses berhasil dihapus');
    }
}
