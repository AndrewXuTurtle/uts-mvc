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
        $query = TracerStudy::with('alumni');

        // Filter by tahun survey
        if ($request->filled('tahun_survey')) {
            $query->where('tahun_survey', $request->tahun_survey);
        }

        // Filter by status pekerjaan
        if ($request->filled('status_pekerjaan')) {
            $query->where('status_pekerjaan', $request->status_pekerjaan);
        }

        // Filter by status survey
        if ($request->filled('status_survey')) {
            $query->where('status_survey', $request->status_survey);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('posisi_pekerjaan', 'like', "%{$search}%")
                  ->orWhereHas('alumni', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
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
            'nim' => 'required|exists:mahasiswa,nim',
            'tahun_survey' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status_pekerjaan' => 'required|string|max:100',
            'nama_perusahaan' => 'nullable|max:255',
            'posisi' => 'nullable|max:255',
            'posisi_pekerjaan' => 'nullable|max:255',
            'bidang_pekerjaan' => 'nullable|max:255',
            'gaji' => 'nullable|numeric|min:0',
            'gaji_pertama' => 'nullable|numeric|min:0',
            'gaji_sekarang' => 'nullable|numeric|min:0',
            'waktu_tunggu_kerja' => 'nullable|string|max:100',
            'kesesuaian_bidang_studi' => 'nullable|string|max:100',
            'kesesuaian_pekerjaan' => 'nullable|string|max:100',
            'tingkat_pendidikan_pekerjaan' => 'nullable|string|max:100',
            'cara_dapat_kerja' => 'nullable|string|max:255',
            'bulan_sejak_lulus' => 'nullable|integer|min:0',
            'kompetensi_teknis' => 'nullable|integer|min:1|max:5',
            'kompetensi_bahasa_inggris' => 'nullable|integer|min:1|max:5',
            'kompetensi_komunikasi' => 'nullable|integer|min:1|max:5',
            'kompetensi_teamwork' => 'nullable|integer|min:1|max:5',
            'kompetensi_problem_solving' => 'nullable|integer|min:1|max:5',
            'kepuasan_prodi' => 'nullable|integer|min:1|max:5',
            'kepuasan_kurikulum' => 'nullable|integer|min:1|max:5',
            'kepuasan_dosen' => 'nullable|integer|min:1|max:5',
            'kepuasan_fasilitas' => 'nullable|integer|min:1|max:5',
            'saran_prodi' => 'nullable',
            'saran_untuk_prodi' => 'nullable',
            'pesan_untuk_juniors' => 'nullable',
            'kompetensi_didapat' => 'nullable',
            'saran_pengembangan' => 'nullable',
            'tanggal_survey' => 'nullable|date',
            'status_survey' => 'nullable|string|max:50',
        ]);

        // Store nim directly (foreign key)
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
            'nim' => 'required|exists:mahasiswa,nim',
            'tahun_survey' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status_pekerjaan' => 'required|string|max:100',
            'nama_perusahaan' => 'nullable|max:255',
            'posisi' => 'nullable|max:255',
            'posisi_pekerjaan' => 'nullable|max:255',
            'bidang_pekerjaan' => 'nullable|max:255',
            'gaji' => 'nullable|numeric|min:0',
            'gaji_pertama' => 'nullable|numeric|min:0',
            'gaji_sekarang' => 'nullable|numeric|min:0',
            'waktu_tunggu_kerja' => 'nullable|string|max:100',
            'kesesuaian_bidang_studi' => 'nullable|string|max:100',
            'kesesuaian_pekerjaan' => 'nullable|string|max:100',
            'tingkat_pendidikan_pekerjaan' => 'nullable|string|max:100',
            'cara_dapat_kerja' => 'nullable|string|max:255',
            'bulan_sejak_lulus' => 'nullable|integer|min:0',
            'kompetensi_teknis' => 'nullable|integer|min:1|max:5',
            'kompetensi_bahasa_inggris' => 'nullable|integer|min:1|max:5',
            'kompetensi_komunikasi' => 'nullable|integer|min:1|max:5',
            'kompetensi_teamwork' => 'nullable|integer|min:1|max:5',
            'kompetensi_problem_solving' => 'nullable|integer|min:1|max:5',
            'kepuasan_prodi' => 'nullable|integer|min:1|max:5',
            'kepuasan_kurikulum' => 'nullable|integer|min:1|max:5',
            'kepuasan_dosen' => 'nullable|integer|min:1|max:5',
            'kepuasan_fasilitas' => 'nullable|integer|min:1|max:5',
            'saran_prodi' => 'nullable',
            'saran_untuk_prodi' => 'nullable',
            'pesan_untuk_juniors' => 'nullable',
            'kompetensi_didapat' => 'nullable',
            'saran_pengembangan' => 'nullable',
            'tanggal_survey' => 'nullable|date',
            'status_survey' => 'nullable|string|max:50',
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
