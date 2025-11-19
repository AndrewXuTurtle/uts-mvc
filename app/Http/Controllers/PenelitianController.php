<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penelitian::with('ketuaPeneliti');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->status($request->status);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->tahun($request->tahun);
        }

        // Filter berdasarkan dosen
        if ($request->filled('ketua_peneliti_id')) {
            $query->where('ketua_peneliti_id', $request->ketua_peneliti_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $penelitian = $query->orderBy('tahun', 'desc')
                           ->orderBy('tanggal_mulai', 'desc')
                           ->paginate(12);

        // Get filter options
        $statusList = ['Draft', 'Sedang Berjalan', 'Selesai'];
        $tahunList = Penelitian::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        $dosenList = Dosen::orderBy('nama')->get();

        return view('penelitian.index', compact('penelitian', 'statusList', 'tahunList', 'dosenList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();
        return view('penelitian.create', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ketua_peneliti_id' => 'required|exists:dosen,id',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:Draft,Sedang Berjalan,Selesai',
            'jenis_penelitian' => 'nullable|string|max:255',
            'sumber_dana' => 'nullable|string|max:255',
            'dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'output' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Handle file uploads
        if ($request->hasFile('file_dokumen')) {
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('penelitian/dokumen', 'public');
        }

        Penelitian::create($validated);

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penelitian = Penelitian::with('dosen')->findOrFail($id);
        return view('penelitian.show', compact('penelitian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penelitian = Penelitian::findOrFail($id);
        $dosen = Dosen::orderBy('nama')->get();
        return view('penelitian.edit', compact('penelitian', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penelitian = Penelitian::findOrFail($id);

        $validated = $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ketua_peneliti_id' => 'required|exists:dosen,id',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:Draft,Sedang Berjalan,Selesai',
            'jenis_penelitian' => 'nullable|string|max:255',
            'sumber_dana' => 'nullable|string|max:255',
            'dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'output' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Handle file uploads
        if ($request->hasFile('file_dokumen')) {
            // Delete old file if exists
            if ($penelitian->file_dokumen) {
                Storage::disk('public')->delete($penelitian->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('penelitian/dokumen', 'public');
        }

        $penelitian->update($validated);

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penelitian = Penelitian::findOrFail($id);

        // Delete associated files
        if ($penelitian->file_dokumen) {
            Storage::disk('public')->delete($penelitian->file_dokumen);
        }

        $penelitian->delete();

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil dihapus!');
    }
}
