<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alumni::with('mahasiswa');

        // Filter berdasarkan status data
        if ($request->filled('status_data')) {
            $query->where('status_data', $request->status_data);
        }

        // Filter berdasarkan pekerjaan saat ini
        if ($request->filled('pekerjaan_saat_ini')) {
            $query->where('pekerjaan_saat_ini', $request->pekerjaan_saat_ini);
        }

        // Search by NIM or name from mahasiswa relation
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        
        if ($sortBy === 'nama') {
            // Sort by mahasiswa nama
            $alumni = $query->get()->sortBy(function($item) {
                return $item->mahasiswa->nama ?? '';
            });
            if ($sortOrder === 'desc') {
                $alumni = $alumni->reverse();
            }
            $alumni = $alumni->values();
        } else {
            $query->orderBy($sortBy, $sortOrder);
            $alumni = $query->get();
        }

        // Transform data untuk API response
        $transformedAlumni = $alumni->map(function ($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                'nama' => $item->mahasiswa->nama ?? 'N/A',
                'email' => $item->mahasiswa->email ?? 'N/A',
                'prodi' => $item->mahasiswa->prodi ?? 'N/A',
                'tahun_lulus' => $item->mahasiswa->tahun_lulus ?? null,
                'pekerjaan_saat_ini' => $item->pekerjaan_saat_ini,
                'nama_perusahaan' => $item->nama_perusahaan,
                'posisi_jabatan' => $item->posisi_jabatan,
                'gaji_pertama' => $item->gaji_pertama,
                'gaji_saat_ini' => $item->gaji_saat_ini,
                'waktu_tunggu_pekerjaan' => $item->waktu_tunggu_pekerjaan,
                'kesesuaian_bidang' => $item->kesesuaian_bidang,
                'status_data' => $item->status_data,
                'linkedin' => $item->linkedin,
                'instagram' => $item->instagram,
                'pesan_alumni' => $item->pesan_alumni,
                'foto_alumni' => $item->foto_alumni,
                'foto_url' => $item->foto_alumni ? asset('storage/' . $item->foto_alumni) : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $transformedAlumni
        ]);
    }

    /**
     * Get statistics for alumni
     */
    public function statistics()
    {
        $totalAlumni = Alumni::count();
        $alumniBekerja = Alumni::where('pekerjaan_saat_ini', 'like', '%Bekerja%')->count();
        $alumniWirausaha = Alumni::where('pekerjaan_saat_ini', 'Wirausaha')->count();
        $alumniStudi = Alumni::where('pekerjaan_saat_ini', 'Melanjutkan Studi')->count();

        // Calculate average gaji
        $avgGajiPertama = Alumni::whereNotNull('gaji_pertama')->avg('gaji_pertama');
        $avgGajiSekarang = Alumni::whereNotNull('gaji_saat_ini')->avg('gaji_saat_ini');

        // Calculate average waktu tunggu
        $avgWaktuTunggu = Alumni::whereNotNull('waktu_tunggu_pekerjaan')->avg('waktu_tunggu_pekerjaan');

        // Kesesuaian bidang
        $kesesuaianBidang = Alumni::selectRaw('kesesuaian_bidang, COUNT(*) as total')
                                ->whereNotNull('kesesuaian_bidang')
                                ->groupBy('kesesuaian_bidang')
                                ->get();

        // Employment rate
        $employmentRate = $totalAlumni > 0 
            ? (($alumniBekerja + $alumniWirausaha) / $totalAlumni) * 100 
            : 0;

        $stats = [
            'total_alumni' => $totalAlumni,
            'alumni_bekerja' => $alumniBekerja,
            'alumni_wirausaha' => $alumniWirausaha,
            'alumni_melanjutkan_studi' => $alumniStudi,
            'employment_rate' => round($employmentRate, 2),
            'average_gaji_pertama' => round($avgGajiPertama ?? 0, 2),
            'average_gaji_sekarang' => round($avgGajiSekarang ?? 0, 2),
            'average_waktu_tunggu_bulan' => round($avgWaktuTunggu ?? 0, 1),
            'kesesuaian_bidang' => $kesesuaianBidang,
            'status_data' => [
                'lengkap' => Alumni::where('status_data', 'Lengkap')->count(),
                'belum_lengkap' => Alumni::where('status_data', 'Belum Lengkap')->count(),
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Note: Alumni data is created through conversion from Mahasiswa.
     * Direct CRUD operations (store, update, destroy) are not available via API.
     * Use the web interface to convert Mahasiswa to Alumni.
     */
}
