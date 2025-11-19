<?php

namespace App\Http\Controllers;

use App\Models\PKM;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PKM::with(['dosen', 'mahasiswa']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_pkm', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('jenis_pkm', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by tahun
        if ($request->has('tahun') && !empty($request->tahun)) {
            $query->where('tahun', $request->tahun);
        }

        // Filter by dosen
        if ($request->has('dosen_id') && !empty($request->dosen_id)) {
            $query->where('dosen_pembimbing_id', $request->dosen_id);
        }

        // Filter by mahasiswa
        if ($request->has('mahasiswa_id') && !empty($request->mahasiswa_id)) {
            $query->whereHas('mahasiswas', function($q) use ($request) {
                $q->where('nim', $request->mahasiswa_id);
            });
        }

        $pkm = $query->orderBy('tahun', 'desc')->orderBy('judul_pkm')->paginate(10);

        // Get filter options
        $statusList = ['Proposal' => 'Proposal', 'Didanai' => 'Didanai', 'Selesai' => 'Selesai', 'Ditolak' => 'Ditolak'];
        $tahunList = PKM::distinct()->pluck('tahun')->sort()->reverse();
        $dosenList = Dosen::orderBy('nama')->get();
        $mahasiswaList = Mahasiswa::orderBy('nama')->get();

        return view('pkm.index', compact('pkm', 'statusList', 'tahunList', 'dosenList', 'mahasiswaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();
        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        return view('pkm.create', compact('dosen', 'mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_pkm' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'jenis_pkm' => 'required|in:PKM-R,PKM-K,PKM-M,PKM-T,PKM-KC,PKM-AI,PKM-GT',
            'status' => 'required|string|in:Proposal,Didanai,Selesai,Ditolak',
            'dana' => 'nullable|numeric|min:0',
            'pencapaian' => 'nullable|string|max:255',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'dosen_pembimbing_id' => 'required|exists:dosen,id',
            'mahasiswa_nim' => 'required|array|min:1',
            'mahasiswa_nim.*' => 'exists:mahasiswa,nim',
            'mahasiswa_peran' => 'nullable|array',
        ]);

        // Handle file upload
        if ($request->hasFile('file_dokumen')) {
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('pkm/dokumen', 'public');
        }

        $pkm = PKM::create($validated);

        // Sync mahasiswa dengan peran
        if ($request->has('mahasiswa_nim')) {
            $mahasiswaData = [];
            foreach ($request->mahasiswa_nim as $index => $nim) {
                $mahasiswaData[$nim] = [
                    'peran' => $request->mahasiswa_peran[$index] ?? 'Anggota'
                ];
            }
            $pkm->mahasiswas()->sync($mahasiswaData);
        }

        return redirect()->route('pkm.index')
            ->with('success', 'Data PKM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PKM $pkm)
    {
        $pkm->load(['dosenPembimbing', 'mahasiswas']);
        return view('pkm.show', compact('pkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PKM $pkm)
    {
        $dosen = Dosen::orderBy('nama')->get();
        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        return view('pkm.edit', compact('pkm', 'dosen', 'mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PKM $pkm)
    {
        $validated = $request->validate([
            'judul_pkm' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'jenis_pkm' => 'required|in:PKM-R,PKM-K,PKM-M,PKM-T,PKM-KC,PKM-AI,PKM-GT',
            'status' => 'required|string|in:Proposal,Didanai,Selesai,Ditolak',
            'dana' => 'nullable|numeric|min:0',
            'pencapaian' => 'nullable|string|max:255',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'dosen_pembimbing_id' => 'required|exists:dosen,id',
            'mahasiswa_nim' => 'required|array|min:1',
            'mahasiswa_nim.*' => 'exists:mahasiswa,nim',
            'mahasiswa_peran' => 'nullable|array',
        ]);

        // Handle file upload
        if ($request->hasFile('file_dokumen')) {
            // Delete old file
            if ($pkm->file_dokumen) {
                Storage::disk('public')->delete($pkm->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('pkm/dokumen', 'public');
        }

        $pkm->update($validated);

        // Sync mahasiswa dengan peran
        if ($request->has('mahasiswa_nim')) {
            $mahasiswaData = [];
            foreach ($request->mahasiswa_nim as $index => $nim) {
                $mahasiswaData[$nim] = [
                    'peran' => $request->mahasiswa_peran[$index] ?? 'Anggota'
                ];
            }
            $pkm->mahasiswas()->sync($mahasiswaData);
        }

        return redirect()->route('pkm.show', $pkm)
            ->with('success', 'Data PKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PKM $pkm)
    {
        // Delete dokumentasi images if they exist
        if ($pkm->file_dokumen) {
            Storage::disk('public')->delete($pkm->file_dokumen);
        }

        $pkm->delete();

        return redirect()->route('pkm.index')
            ->with('success', 'Data PKM berhasil dihapus.');
    }
}
