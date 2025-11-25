<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KisahSukses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class KisahSuksesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KisahSukses::with('mahasiswa');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            // Default: only show published
            $query->where('status', 'Published');
        }

        // Filter by tahun_pencapaian
        if ($request->filled('tahun_pencapaian')) {
            $query->where('tahun_pencapaian', $request->tahun_pencapaian);
        }

        // Search by judul or kisah
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kisah', 'like', "%{$search}%");
            });
        }

        $kisahSukses = $query->orderBy('created_at', 'desc')->get();

        // Transform data
        $data = $kisahSukses->map(function ($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                'mahasiswa' => [
                    'nim' => $item->mahasiswa->nim ?? null,
                    'nama' => $item->mahasiswa->nama ?? 'N/A',
                    'email' => $item->mahasiswa->email ?? null,
                ],
                'judul' => $item->judul,
                'kisah' => $item->kisah,
                'pencapaian' => $item->pencapaian,
                'tahun_pencapaian' => $item->tahun_pencapaian,
                'foto' => $item->foto,
                'foto_url' => $item->foto ? asset('storage/' . $item->foto) : null,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kisahSukses = KisahSukses::with('mahasiswa')->findOrFail($id);

        $data = [
            'id' => $kisahSukses->id,
            'nim' => $kisahSukses->nim,
            'mahasiswa' => [
                'nim' => $kisahSukses->mahasiswa->nim ?? null,
                'nama' => $kisahSukses->mahasiswa->nama ?? 'N/A',
                'email' => $kisahSukses->mahasiswa->email ?? null,
            ],
            'judul' => $kisahSukses->judul,
            'kisah' => $kisahSukses->kisah,
            'pencapaian' => $kisahSukses->pencapaian,
            'tahun_pencapaian' => $kisahSukses->tahun_pencapaian,
            'foto' => $kisahSukses->foto,
            'foto_url' => $kisahSukses->foto ? asset('storage/' . $kisahSukses->foto) : null,
            'status' => $kisahSukses->status,
            'created_at' => $kisahSukses->created_at,
            'updated_at' => $kisahSukses->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get featured kisah sukses (10 latest published)
     */
    public function featured()
    {
        $kisahSukses = KisahSukses::with('mahasiswa')
            ->where('status', 'Published')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $data = $kisahSukses->map(function ($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                'mahasiswa' => [
                    'nim' => $item->mahasiswa->nim ?? null,
                    'nama' => $item->mahasiswa->nama ?? 'N/A',
                ],
                'judul' => $item->judul,
                'kisah' => strlen($item->kisah) > 300 ? substr($item->kisah, 0, 300) . '...' : $item->kisah,
                'pencapaian' => $item->pencapaian,
                'tahun_pencapaian' => $item->tahun_pencapaian,
                'foto' => $item->foto,
                'foto_url' => $item->foto ? asset('storage/' . $item->foto) : null,
                'status' => $item->status,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Get kisah sukses statistics
     */
    public function statistics()
    {
        $total = KisahSukses::count();
        $published = KisahSukses::where('status', 'Published')->count();
        $draft = KisahSukses::where('status', 'Draft')->count();

        // Group by year (tahun_pencapaian)
        $byYear = KisahSukses::where('status', 'Published')
            ->select('tahun_pencapaian as year', DB::raw('count(*) as total'))
            ->groupBy('tahun_pencapaian')
            ->orderBy('tahun_pencapaian', 'desc')
            ->pluck('total', 'year');

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $total,
                'published' => $published,
                'draft' => $draft,
                'by_year' => $byYear,
            ]
        ]);
    }
}
