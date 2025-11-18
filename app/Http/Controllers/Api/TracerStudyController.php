<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TracerStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TracerStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Eager load mahasiswa to get nama, email, prodi
        $query = TracerStudy::with('mahasiswa');

        // Filter by tahun survey
        if ($request->filled('tahun_survey')) {
            $query->where('tahun_survey', $request->tahun_survey);
        }

        // Filter by status pekerjaan
        if ($request->filled('status_pekerjaan')) {
            $query->where('status_pekerjaan', $request->status_pekerjaan);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'tahun_survey');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $perPage = $request->get('per_page', 15);
        $tracerStudy = $query->paginate($perPage);

        // Transform response to include flattened mahasiswa data
        $tracerStudy->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                // Flatten mahasiswa data
                'mahasiswa' => [
                    'nim' => $item->nim,
                    'nama' => $item->mahasiswa->nama ?? 'N/A',
                    'email' => $item->mahasiswa->email ?? null,
                    'prodi' => $item->mahasiswa->prodi ?? null,
                ],
                // Tracer study fields from actual database
                'tahun_survey' => $item->tahun_survey,
                'status_pekerjaan' => $item->status_pekerjaan,
                'nama_perusahaan' => $item->nama_perusahaan,
                'posisi' => $item->posisi,
                'bidang_pekerjaan' => $item->bidang_pekerjaan,
                'gaji' => $item->gaji,
                'waktu_tunggu_kerja' => $item->waktu_tunggu_kerja,
                'kesesuaian_bidang_studi' => $item->kesesuaian_bidang_studi,
                'kepuasan_prodi' => $item->kepuasan_prodi,
                'saran_prodi' => $item->saran_prodi,
                'kompetensi_didapat' => $item->kompetensi_didapat,
                'saran_pengembangan' => $item->saran_pengembangan,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $tracerStudy,
            'message' => 'Data tracer study berhasil diambil'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alumni_id' => 'required|exists:alumni,id',
            'tahun_survey' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan_sejak_lulus' => 'required|integer|min:0',
            'status_pekerjaan' => 'required|in:bekerja_full_time,bekerja_part_time,wiraswasta,melanjutkan_studi,tidak_bekerja,freelance',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi_pekerjaan' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',
            'tingkat_pendidikan_pekerjaan' => 'nullable|in:D3,S1,S2,S3,tidak_perlu',
            'gaji_pertama' => 'nullable|numeric|min:0',
            'gaji_sekarang' => 'nullable|numeric|min:0',
            'kesesuaian_pekerjaan' => 'nullable|in:sangat_sesuai,sesuai,cukup_sesuai,kurang_sesuai,tidak_sesuai',
            'waktu_tunggu_kerja' => 'nullable|in:kurang_3_bulan,3_6_bulan,6_12_bulan,lebih_12_bulan,belum_bekerja',
            'cara_dapat_kerja' => 'nullable|string|max:255',
            'kompetensi_teknis' => 'nullable|integer|min:1|max:5',
            'kompetensi_bahasa_inggris' => 'nullable|integer|min:1|max:5',
            'kompetensi_komunikasi' => 'nullable|integer|min:1|max:5',
            'kompetensi_teamwork' => 'nullable|integer|min:1|max:5',
            'kompetensi_problem_solving' => 'nullable|integer|min:1|max:5',
            'kepuasan_kurikulum' => 'nullable|integer|min:1|max:5',
            'kepuasan_dosen' => 'nullable|integer|min:1|max:5',
            'kepuasan_fasilitas' => 'nullable|integer|min:1|max:5',
            'saran_untuk_prodi' => 'nullable|string',
            'pesan_untuk_juniors' => 'nullable|string',
            'tanggal_survey' => 'required|date',
            'status_survey' => 'required|in:draft,completed,verified',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tracerStudy = TracerStudy::create($request->all());
        $tracerStudy->load('alumni');

        return response()->json([
            'success' => true,
            'message' => 'Data tracer study berhasil ditambahkan',
            'data' => $tracerStudy
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tracerStudy = TracerStudy::with('alumni.mahasiswa')->findOrFail($id);

        $data = [
            'id' => $tracerStudy->id,
            'nim' => $tracerStudy->nim,
            // Flatten alumni + mahasiswa data
            'alumni' => [
                'nim' => $tracerStudy->alumni->nim ?? null,
                'nama' => $tracerStudy->alumni->mahasiswa->nama ?? 'N/A',
                'email' => $tracerStudy->alumni->mahasiswa->email ?? null,
                'prodi' => $tracerStudy->alumni->mahasiswa->prodi ?? null,
                'tahun_lulus' => $tracerStudy->alumni->mahasiswa->tahun_lulus ?? null,
                'kelas' => $tracerStudy->alumni->mahasiswa->kelas ?? null,
                'foto_alumni' => $tracerStudy->alumni->foto_alumni,
                'foto_url' => $tracerStudy->alumni->foto_alumni ? asset('storage/' . $tracerStudy->alumni->foto_alumni) : null,
                // Alumni-specific data
                'pekerjaan_saat_ini' => $tracerStudy->alumni->pekerjaan_saat_ini,
                'nama_perusahaan' => $tracerStudy->alumni->nama_perusahaan,
                'posisi_jabatan' => $tracerStudy->alumni->posisi_jabatan,
            ],
            // All tracer study fields
            'tahun_survey' => $tracerStudy->tahun_survey,
            'bulan_sejak_lulus' => $tracerStudy->bulan_sejak_lulus,
            'status_pekerjaan' => $tracerStudy->status_pekerjaan,
            'nama_perusahaan' => $tracerStudy->nama_perusahaan,
            'posisi_pekerjaan' => $tracerStudy->posisi_pekerjaan,
            'bidang_pekerjaan' => $tracerStudy->bidang_pekerjaan,
            'tingkat_pendidikan_pekerjaan' => $tracerStudy->tingkat_pendidikan_pekerjaan,
            'gaji_pertama' => $tracerStudy->gaji_pertama,
            'gaji_sekarang' => $tracerStudy->gaji_sekarang,
            'kesesuaian_pekerjaan' => $tracerStudy->kesesuaian_pekerjaan,
            'waktu_tunggu_kerja' => $tracerStudy->waktu_tunggu_kerja,
            'cara_dapat_kerja' => $tracerStudy->cara_dapat_kerja,
            'kompetensi_teknis' => $tracerStudy->kompetensi_teknis,
            'kompetensi_bahasa_inggris' => $tracerStudy->kompetensi_bahasa_inggris,
            'kompetensi_komunikasi' => $tracerStudy->kompetensi_komunikasi,
            'kompetensi_teamwork' => $tracerStudy->kompetensi_teamwork,
            'kompetensi_problem_solving' => $tracerStudy->kompetensi_problem_solving,
            'kepuasan_kurikulum' => $tracerStudy->kepuasan_kurikulum,
            'kepuasan_dosen' => $tracerStudy->kepuasan_dosen,
            'kepuasan_fasilitas' => $tracerStudy->kepuasan_fasilitas,
            'saran_untuk_prodi' => $tracerStudy->saran_untuk_prodi,
            'pesan_untuk_juniors' => $tracerStudy->pesan_untuk_juniors,
            'tanggal_survey' => $tracerStudy->tanggal_survey,
            'status_survey' => $tracerStudy->status_survey,
            'created_at' => $tracerStudy->created_at,
            'updated_at' => $tracerStudy->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Detail tracer study berhasil diambil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tracerStudy = TracerStudy::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'alumni_id' => 'required|exists:alumni,id',
            'tahun_survey' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan_sejak_lulus' => 'required|integer|min:0',
            'status_pekerjaan' => 'required|in:bekerja_full_time,bekerja_part_time,wiraswasta,melanjutkan_studi,tidak_bekerja,freelance',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi_pekerjaan' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',
            'tingkat_pendidikan_pekerjaan' => 'nullable|in:D3,S1,S2,S3,tidak_perlu',
            'gaji_pertama' => 'nullable|numeric|min:0',
            'gaji_sekarang' => 'nullable|numeric|min:0',
            'kesesuaian_pekerjaan' => 'nullable|in:sangat_sesuai,sesuai,cukup_sesuai,kurang_sesuai,tidak_sesuai',
            'waktu_tunggu_kerja' => 'nullable|in:kurang_3_bulan,3_6_bulan,6_12_bulan,lebih_12_bulan,belum_bekerja',
            'cara_dapat_kerja' => 'nullable|string|max:255',
            'kompetensi_teknis' => 'nullable|integer|min:1|max:5',
            'kompetensi_bahasa_inggris' => 'nullable|integer|min:1|max:5',
            'kompetensi_komunikasi' => 'nullable|integer|min:1|max:5',
            'kompetensi_teamwork' => 'nullable|integer|min:1|max:5',
            'kompetensi_problem_solving' => 'nullable|integer|min:1|max:5',
            'kepuasan_kurikulum' => 'nullable|integer|min:1|max:5',
            'kepuasan_dosen' => 'nullable|integer|min:1|max:5',
            'kepuasan_fasilitas' => 'nullable|integer|min:1|max:5',
            'saran_untuk_prodi' => 'nullable|string',
            'pesan_untuk_juniors' => 'nullable|string',
            'tanggal_survey' => 'required|date',
            'status_survey' => 'required|in:draft,completed,verified',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tracerStudy->update($request->all());
        $tracerStudy->load('alumni');

        return response()->json([
            'success' => true,
            'message' => 'Data tracer study berhasil diperbarui',
            'data' => $tracerStudy
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tracerStudy = TracerStudy::findOrFail($id);
        $tracerStudy->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data tracer study berhasil dihapus'
        ]);
    }

    /**
     * Get statistics and analytics
     */
    public function statistics(Request $request)
    {
        // If no tahun_survey specified, auto-detect latest survey year from database
        // This prevents returning empty stats when current year has no data yet
        $tahunSurvey = $request->get('tahun_survey');
        
        if (!$tahunSurvey) {
            // Get the latest survey year from the database
            $latestYear = TracerStudy::max('tahun_survey');
            $tahunSurvey = $latestYear ?? date('Y'); // Fallback to current year if no data
        }

        $query = TracerStudy::where('tahun_survey', $tahunSurvey);

        // Calculate averages and format as clean numbers
        $avgGaji = TracerStudy::where('tahun_survey', $tahunSurvey)
            ->whereNotNull('gaji')
            ->avg('gaji');
        
        $avgKepuasanProdi = TracerStudy::where('tahun_survey', $tahunSurvey)
            ->whereNotNull('kepuasan_prodi')
            ->avg('kepuasan_prodi');

        $stats = [
            'total_respondents' => $query->count(),
            
            // Status Pekerjaan Distribution
            'status_pekerjaan' => TracerStudy::where('tahun_survey', $tahunSurvey)
                ->selectRaw('status_pekerjaan, COUNT(*) as total')
                ->whereNotNull('status_pekerjaan')
                ->groupBy('status_pekerjaan')
                ->get()
                ->pluck('total', 'status_pekerjaan'),
            
            // Waktu Tunggu Kerja
            'waktu_tunggu_kerja' => TracerStudy::where('tahun_survey', $tahunSurvey)
                ->whereNotNull('waktu_tunggu_kerja')
                ->selectRaw('waktu_tunggu_kerja, COUNT(*) as total')
                ->groupBy('waktu_tunggu_kerja')
                ->get()
                ->pluck('total', 'waktu_tunggu_kerja'),
            
            // Kesesuaian Bidang Studi
            'kesesuaian_bidang_studi' => TracerStudy::where('tahun_survey', $tahunSurvey)
                ->whereNotNull('kesesuaian_bidang_studi')
                ->selectRaw('kesesuaian_bidang_studi, COUNT(*) as total')
                ->groupBy('kesesuaian_bidang_studi')
                ->get()
                ->pluck('total', 'kesesuaian_bidang_studi'),
            
            // Average Gaji - format as clean number (round to 2 decimals)
            'avg_gaji' => $avgGaji ? round($avgGaji, 2) : null,
            
            // Average Kepuasan Prodi - format as clean number (round to 1 decimal)
            'avg_kepuasan_prodi' => $avgKepuasanProdi ? round($avgKepuasanProdi, 1) : null,
            
            // Employment Rate (yang bekerja / total)
            'employment_rate' => $this->calculateEmploymentRate($tahunSurvey),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'tahun_survey' => $tahunSurvey,
            'message' => 'Statistik tracer study berhasil diambil'
        ]);
    }

    /**
     * Calculate employment rate
     */
    private function calculateEmploymentRate($tahunSurvey)
    {
        $total = TracerStudy::where('tahun_survey', $tahunSurvey)->count();
        if ($total == 0) return 0;

        $employed = TracerStudy::where('tahun_survey', $tahunSurvey)
            ->where('status_pekerjaan', '!=', 'tidak_bekerja')
            ->whereNotNull('status_pekerjaan')
            ->count();

        return round(($employed / $total) * 100, 2);
    }

    /**
     * Get alumni testimonials (saran & pesan)
     */
    public function testimonials(Request $request)
    {
        $query = TracerStudy::with('mahasiswa')
            ->whereNotNull('saran_prodi')
            ->orderBy('tahun_survey', 'desc');

        $testimonials = $query->paginate($request->get('per_page', 10));

        // Transform to include mahasiswa data
        $testimonials->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                'mahasiswa' => [
                    'nama' => $item->mahasiswa->nama ?? 'N/A',
                    'prodi' => $item->mahasiswa->prodi ?? null,
                ],
                'saran_prodi' => $item->saran_prodi,
                'saran_pengembangan' => $item->saran_pengembangan,
                'tahun_survey' => $item->tahun_survey,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $testimonials,
            'message' => 'Testimonial alumni berhasil diambil'
        ]);
    }
}
