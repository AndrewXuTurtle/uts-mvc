<?php

namespace App\Http\Controllers;

use App\Models\TracerStudy;
use App\Models\Alumni;
use Illuminate\Http\Request;

class TracerStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TracerStudy::with('alumni.mahasiswa');

        // Filter by tahun survey
        if ($request->filled('tahun_survey')) {
            $query->where('tahun_survey', $request->tahun_survey);
        }

        // Filter by status pekerjaan
        if ($request->filled('status_pekerjaan')) {
            $query->where('status_pekerjaan', $request->status_pekerjaan);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('posisi', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $tracerStudy = $query->orderBy('tahun_survey', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('tracer-study.index', compact('tracerStudy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Don't load all alumni - let user search by NIM first
        return view('tracer-study.create');
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
            'nim' => 'required|exists:alumni,nim',
            'tahun_survey' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status_pekerjaan' => 'required|in:Bekerja Full Time,Bekerja Part Time,Wiraswasta,Melanjutkan Studi,Belum Bekerja,Freelancer',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',
            'gaji' => 'nullable|numeric|min:0',
            'waktu_tunggu_kerja' => 'nullable|integer|min:0',
            'kesesuaian_bidang_studi' => 'nullable|in:Sangat Sesuai,Sesuai,Cukup Sesuai,Kurang Sesuai,Tidak Sesuai',
            'kepuasan_prodi' => 'nullable|integer|min:1|max:5',
            'saran_prodi' => 'nullable|string',
            'kompetensi_didapat' => 'nullable|string',
            'saran_pengembangan' => 'nullable|string',
        ]);

        TracerStudy::create($validated);

        return redirect()->route('tracer-study.index')
            ->with('success', 'Data tracer study berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tracerStudy = TracerStudy::with('alumni')->findOrFail($id);
        return view('tracer-study.show', compact('tracerStudy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tracerStudy = TracerStudy::with('alumni.mahasiswa')->findOrFail($id);
        $alumni = \App\Models\Alumni::with('mahasiswa')->get()->sortBy('mahasiswa.nama');
        return view('tracer-study.edit', compact('tracerStudy', 'alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tracerStudy = TracerStudy::findOrFail($id);

        $validated = $request->validate([
            'nim' => 'required|exists:alumni,nim',
            'tahun_survey' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status_pekerjaan' => 'required|in:Bekerja Full Time,Bekerja Part Time,Wiraswasta,Melanjutkan Studi,Belum Bekerja,Freelancer',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',
            'gaji' => 'nullable|numeric|min:0',
            'waktu_tunggu_kerja' => 'nullable|integer|min:0',
            'kesesuaian_bidang_studi' => 'nullable|in:Sangat Sesuai,Sesuai,Cukup Sesuai,Kurang Sesuai,Tidak Sesuai',
            'kepuasan_prodi' => 'nullable|integer|min:1|max:5',
            'saran_prodi' => 'nullable|string',
            'kompetensi_didapat' => 'nullable|string',
            'saran_pengembangan' => 'nullable|string',
        ]);

        $tracerStudy->update($validated);

        return redirect()->route('tracer-study.index')
            ->with('success', 'Data tracer study berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tracerStudy = TracerStudy::findOrFail($id);
        $tracerStudy->delete();

        return redirect()->route('tracer-study.index')
            ->with('success', 'Data tracer study berhasil dihapus');
    }
}
