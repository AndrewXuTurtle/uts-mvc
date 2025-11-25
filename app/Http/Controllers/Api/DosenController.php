<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    /**
     * Display a listing of dosen with filters
     * Use for: Grid/List view with click-to-popup
     */
    public function index(Request $request)
    {
        $query = Dosen::query();

        // Search by name, NIDN, or bidang keahlian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nidn', 'like', "%{$search}%")
                  ->orWhere('bidang_keahlian', 'like', "%{$search}%");
            });
        }

        // Filter by status (Aktif/Tidak Aktif)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jabatan
        if ($request->has('jabatan')) {
            $query->where('jabatan', 'like', "%{$request->jabatan}%");
        }

        // Filter by pendidikan terakhir
        if ($request->has('pendidikan')) {
            $query->where('pendidikan_terakhir', 'like', "%{$request->pendidikan}%");
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'nama');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 12);
        $dosen = $query->paginate($perPage);

        // Transform with foto_url
        $dosen->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            $data['foto_url'] = $item->foto ? url('storage/' . $item->foto) : null;
            
            // Add social media links for easy access
            $data['has_google_scholar'] = !empty($item->google_scholar_link);
            $data['has_sinta'] = !empty($item->sinta_link);
            $data['has_scopus'] = !empty($item->scopus_link);
            
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $dosen,
            'message' => 'Data dosen berhasil diambil'
        ]);
    }

    /**
     * Display single dosen detail
     * Use for: Pop-up modal content
     */
    public function show($id)
    {
        $dosen = Dosen::find($id);
        
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        $data = $dosen->toArray();
        $data['foto_url'] = $dosen->foto ? url('storage/' . $dosen->foto) : null;
        
        // Enhanced data for pop-up
        $data['contact_info'] = [
            'email' => $dosen->email,
            'no_hp' => $dosen->no_hp,
        ];
        
        $data['academic_links'] = [
            'google_scholar' => $dosen->google_scholar_link,
            'sinta' => $dosen->sinta_link,
            'scopus' => $dosen->scopus_link,
        ];
        
        $data['academic_info'] = [
            'nidn' => $dosen->nidn,
            'jabatan' => $dosen->jabatan,
            'pendidikan_terakhir' => $dosen->pendidikan_terakhir,
            'bidang_keahlian' => $dosen->bidang_keahlian,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Detail dosen berhasil diambil'
        ]);
    }

    /**
     * Get dosen statistics for dashboard
     */
    public function statistics()
    {
        $stats = [
            'total_dosen' => Dosen::count(),
            'dosen_aktif' => Dosen::where('status', 'Aktif')->count(),
            'by_pendidikan' => Dosen::selectRaw('pendidikan_terakhir, COUNT(*) as total')
                ->groupBy('pendidikan_terakhir')
                ->get()
                ->pluck('total', 'pendidikan_terakhir'),
            'by_jabatan' => Dosen::selectRaw('jabatan, COUNT(*) as total')
                ->where('jabatan', '!=', '')
                ->whereNotNull('jabatan')
                ->groupBy('jabatan')
                ->get()
                ->pluck('total', 'jabatan'),
            'with_google_scholar' => Dosen::whereNotNull('google_scholar_link')
                ->where('google_scholar_link', '!=', '')
                ->count(),
            'with_sinta' => Dosen::whereNotNull('sinta_link')
                ->where('sinta_link', '!=', '')
                ->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Statistik dosen berhasil diambil'
        ]);
    }
}
