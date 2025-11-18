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
        $query = Penelitian::with('dosen');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->status($request->status);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->tahun($request->tahun);
        }

        // Filter berdasarkan dosen
        if ($request->filled('dosen_id')) {
            $query->dosen($request->dosen_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $penelitian = $query->orderBy('tahun', 'desc')
                           ->orderBy('tanggal_mulai', 'desc')
                           ->paginate(12);

        // Get filter options
        $statusList = ['ongoing', 'completed', 'published', 'cancelled'];
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_id' => 'required|exists:tbl_dosen,id',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:ongoing,completed,published,cancelled',
            'bidang_penelitian' => 'required|string|max:255',
            'sumber_dana' => 'nullable|string|max:255',
            'jumlah_dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Handle file uploads
        if ($request->hasFile('file_proposal')) {
            $validated['file_proposal'] = $request->file('file_proposal')->store('penelitian/proposal', 'public');
        }

        if ($request->hasFile('file_laporan')) {
            $validated['file_laporan'] = $request->file('file_laporan')->store('penelitian/laporan', 'public');
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
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_id' => 'required|exists:tbl_dosen,id',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:ongoing,completed,published,cancelled',
            'bidang_penelitian' => 'required|string|max:255',
            'sumber_dana' => 'nullable|string|max:255',
            'jumlah_dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
            'file_laporan' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Handle file uploads
        if ($request->hasFile('file_proposal')) {
            // Delete old file if exists
            if ($penelitian->file_proposal) {
                Storage::disk('public')->delete($penelitian->file_proposal);
            }
            $validated['file_proposal'] = $request->file('file_proposal')->store('penelitian/proposal', 'public');
        }

        if ($request->hasFile('file_laporan')) {
            // Delete old file if exists
            if ($penelitian->file_laporan) {
                Storage::disk('public')->delete($penelitian->file_laporan);
            }
            $validated['file_laporan'] = $request->file('file_laporan')->store('penelitian/laporan', 'public');
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
        if ($penelitian->file_proposal) {
            Storage::disk('public')->delete($penelitian->file_proposal);
        }

        if ($penelitian->file_laporan) {
            Storage::disk('public')->delete($penelitian->file_laporan);
        }

        $penelitian->delete();

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil dihapus!');
    }
}
