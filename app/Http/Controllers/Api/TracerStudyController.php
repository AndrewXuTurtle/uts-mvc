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
        // Eager load alumni and mahasiswa relationships
        $query = TracerStudy::with('alumni.mahasiswa');

        // Filter by tahun survey
        if ($request->filled('tahun_survey')) {
            $query->where('tahun_survey', $request->tahun_survey);
        }

        // Filter by status pekerjaan
        if ($request->filled('status_pekerjaan')) {
            $query->where('status_pekerjaan', $request->status_pekerjaan);
        }

        // Filter by kesesuaian bidang studi
        if ($request->filled('kesesuaian_bidang_studi')) {
            $query->where('kesesuaian_bidang_studi', $request->kesesuaian_bidang_studi);
        }

        // Filter by range waktu tunggu kerja (in months)
        if ($request->filled('waktu_tunggu_min')) {
            $query->where('waktu_tunggu_kerja', '>=', $request->waktu_tunggu_min);
        }
        if ($request->filled('waktu_tunggu_max')) {
            $query->where('waktu_tunggu_kerja', '<=', $request->waktu_tunggu_max);
        }

        // Filter by gaji range
        if ($request->filled('gaji_min')) {
            $query->where('gaji', '>=', $request->gaji_min);
        }
        if ($request->filled('gaji_max')) {
            $query->where('gaji', '<=', $request->gaji_max);
        }

        // Search by alumni name or company
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('posisi', 'like', "%{$search}%")
                  ->orWhereHas('alumni.mahasiswa', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'tahun_survey');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $perPage = $request->get('per_page', 15);
        $tracerStudy = $query->paginate($perPage);

        // Transform response to include complete data with alumni info
        $tracerStudy->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                // Alumni and mahasiswa data
                'alumni' => [
                    'nim' => $item->nim,
                    'nama' => $item->alumni->mahasiswa->nama ?? 'N/A',
                    'email' => $item->alumni->mahasiswa->email ?? null,
                    'prodi' => $item->alumni->mahasiswa->prodi ?? null,
                    'tahun_lulus' => $item->alumni->tahun_lulus ?? null,
                    'foto' => $item->alumni->mahasiswa->foto ?? null,
                    'foto_url' => $item->alumni->mahasiswa->foto ? url('storage/' . $item->alumni->mahasiswa->foto) : null,
                ],
                // All tracer study fields (13 actual database fields)
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tracerStudy = TracerStudy::create($request->all());
        $tracerStudy->load('alumni.mahasiswa');

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
            // Complete alumni + mahasiswa data
            'alumni' => [
                'nim' => $tracerStudy->nim,
                'nama' => $tracerStudy->alumni->mahasiswa->nama ?? 'N/A',
                'email' => $tracerStudy->alumni->mahasiswa->email ?? null,
                'prodi' => $tracerStudy->alumni->mahasiswa->prodi ?? null,
                'tahun_lulus' => $tracerStudy->alumni->tahun_lulus ?? null,
                'kelas' => $tracerStudy->alumni->mahasiswa->kelas ?? null,
                'foto' => $tracerStudy->alumni->mahasiswa->foto ?? null,
                'foto_url' => $tracerStudy->alumni->mahasiswa->foto ? url('storage/' . $tracerStudy->alumni->mahasiswa->foto) : null,
            ],
            // All 13 tracer study fields from actual database
            'tahun_survey' => $tracerStudy->tahun_survey,
            'status_pekerjaan' => $tracerStudy->status_pekerjaan,
            'nama_perusahaan' => $tracerStudy->nama_perusahaan,
            'posisi' => $tracerStudy->posisi,
            'bidang_pekerjaan' => $tracerStudy->bidang_pekerjaan,
            'gaji' => $tracerStudy->gaji,
            'waktu_tunggu_kerja' => $tracerStudy->waktu_tunggu_kerja,
            'kesesuaian_bidang_studi' => $tracerStudy->kesesuaian_bidang_studi,
            'kepuasan_prodi' => $tracerStudy->kepuasan_prodi,
            'saran_prodi' => $tracerStudy->saran_prodi,
            'kompetensi_didapat' => $tracerStudy->kompetensi_didapat,
            'saran_pengembangan' => $tracerStudy->saran_pengembangan,
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tracerStudy->update($request->all());
        $tracerStudy->load('alumni.mahasiswa');

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
        $tahunSurvey = $request->get('tahun_survey');
        
        if (!$tahunSurvey) {
            $latestYear = TracerStudy::max('tahun_survey');
            $tahunSurvey = $latestYear ?? date('Y');
        }

        $query = TracerStudy::where('tahun_survey', $tahunSurvey);

        // Calculate averages
        $avgGaji = TracerStudy::where('tahun_survey', $tahunSurvey)
            ->whereNotNull('gaji')
            ->avg('gaji');
        
        $avgKepuasanProdi = TracerStudy::where('tahun_survey', $tahunSurvey)
            ->whereNotNull('kepuasan_prodi')
            ->avg('kepuasan_prodi');
        
        $avgWaktuTunggu = TracerStudy::where('tahun_survey', $tahunSurvey)
            ->whereNotNull('waktu_tunggu_kerja')
            ->avg('waktu_tunggu_kerja');

        $stats = [
            'total_respondents' => $query->count(),
            
            // Status Pekerjaan Distribution
            'status_pekerjaan' => TracerStudy::where('tahun_survey', $tahunSurvey)
                ->selectRaw('status_pekerjaan, COUNT(*) as total')
                ->whereNotNull('status_pekerjaan')
                ->groupBy('status_pekerjaan')
                ->get()
                ->mapWithKeys(function($item) {
                    return [$item->status_pekerjaan => $item->total];
                }),
            
            // Waktu Tunggu Kerja Distribution (in months)
            'waktu_tunggu_kerja_distribution' => [
                '0-3_bulan' => TracerStudy::where('tahun_survey', $tahunSurvey)
                    ->whereBetween('waktu_tunggu_kerja', [0, 3])->count(),
                '4-6_bulan' => TracerStudy::where('tahun_survey', $tahunSurvey)
                    ->whereBetween('waktu_tunggu_kerja', [4, 6])->count(),
                '7-12_bulan' => TracerStudy::where('tahun_survey', $tahunSurvey)
                    ->whereBetween('waktu_tunggu_kerja', [7, 12])->count(),
                'lebih_12_bulan' => TracerStudy::where('tahun_survey', $tahunSurvey)
                    ->where('waktu_tunggu_kerja', '>', 12)->count(),
            ],
            
            // Kesesuaian Bidang Studi Distribution
            'kesesuaian_bidang_studi' => TracerStudy::where('tahun_survey', $tahunSurvey)
                ->whereNotNull('kesesuaian_bidang_studi')
                ->selectRaw('kesesuaian_bidang_studi, COUNT(*) as total')
                ->groupBy('kesesuaian_bidang_studi')
                ->get()
                ->mapWithKeys(function($item) {
                    return [$item->kesesuaian_bidang_studi => $item->total];
                }),
            
            // Averages
            'avg_gaji' => $avgGaji ? round($avgGaji, 2) : null,
            'avg_kepuasan_prodi' => $avgKepuasanProdi ? round($avgKepuasanProdi, 1) : null,
            'avg_waktu_tunggu_kerja' => $avgWaktuTunggu ? round($avgWaktuTunggu, 1) : null,
            
            // Employment Rate
            'employment_rate' => $this->calculateEmploymentRate($tahunSurvey),
            
            // Top 10 companies
            'top_companies' => TracerStudy::where('tahun_survey', $tahunSurvey)
                ->whereNotNull('nama_perusahaan')
                ->selectRaw('nama_perusahaan, COUNT(*) as total')
                ->groupBy('nama_perusahaan')
                ->orderBy('total', 'desc')
                ->limit(10)
                ->get(),
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
            ->whereIn('status_pekerjaan', ['Bekerja Full Time', 'Bekerja Part Time', 'Wiraswasta', 'Freelancer'])
            ->count();

        return round(($employed / $total) * 100, 2);
    }

    /**
     * Get alumni testimonials (saran & pesan)
     */
    public function testimonials(Request $request)
    {
        $query = TracerStudy::with('alumni.mahasiswa')
            ->where(function($q) {
                $q->whereNotNull('saran_prodi')
                  ->orWhereNotNull('saran_pengembangan');
            })
            ->orderBy('tahun_survey', 'desc');

        $testimonials = $query->paginate($request->get('per_page', 10));

        // Transform to include alumni data
        $testimonials->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                'alumni' => [
                    'nama' => $item->alumni->mahasiswa->nama ?? 'N/A',
                    'prodi' => $item->alumni->mahasiswa->prodi ?? null,
                    'tahun_lulus' => $item->alumni->tahun_lulus ?? null,
                    'foto' => $item->alumni->mahasiswa->foto ?? null,
                    'foto_url' => $item->alumni->mahasiswa->foto ? url('storage/' . $item->alumni->mahasiswa->foto) : null,
                ],
                'saran_prodi' => $item->saran_prodi,
                'kompetensi_didapat' => $item->kompetensi_didapat,
                'saran_pengembangan' => $item->saran_pengembangan,
                'tahun_survey' => $item->tahun_survey,
                'status_pekerjaan' => $item->status_pekerjaan,
                'nama_perusahaan' => $item->nama_perusahaan,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $testimonials,
            'message' => 'Testimonial alumni berhasil diambil'
        ]);
    }
}
