<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kurikulum::query();

        // Filter by semester
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        // Search by kode or nama matkul
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_matkul', 'like', "%{$search}%")
                  ->orWhere('nama_matkul', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'semester');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder)->orderBy('kode_matkul', 'asc');

        $perPage = $request->get('per_page', 50);
        $kurikulum = $query->paginate($perPage);

        // Add cover_foto_url if exists
        $kurikulum->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            $data['cover_foto_url'] = $item->cover_foto ? url('storage/' . $item->cover_foto) : null;
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $kurikulum,
            'message' => 'Data kurikulum berhasil diambil'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|string|max:255|unique:kurikulum,kode_matkul',
            'nama_matkul' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'deskripsi' => 'nullable|string',
            'cover_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_foto')) {
            $validated['cover_foto'] = $request->file('cover_foto')->store('kurikulum', 'public');
        }

        $kurikulum = Kurikulum::create($validated);

        $data = $kurikulum->toArray();
        $data['cover_foto_url'] = $kurikulum->cover_foto ? url('storage/' . $kurikulum->cover_foto) : null;

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kurikulum = Kurikulum::find($id);
        
        if (!$kurikulum) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        $data = $kurikulum->toArray();
        $data['cover_foto_url'] = $kurikulum->cover_foto ? url('storage/' . $kurikulum->cover_foto) : null;

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Detail mata kuliah berhasil diambil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kurikulum = Kurikulum::find($id);
        
        if (!$kurikulum) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kode_matkul' => 'required|string|max:255|unique:kurikulum,kode_matkul,' . $id,
            'nama_matkul' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
            'sks' => 'required|integer|min:1|max:6',
            'deskripsi' => 'nullable|string',
            'cover_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_foto')) {
            // Delete old cover_foto if exists
            if ($kurikulum->cover_foto) {
                \Storage::disk('public')->delete($kurikulum->cover_foto);
            }
            $validated['cover_foto'] = $request->file('cover_foto')->store('kurikulum', 'public');
        }

        $kurikulum->update($validated);

        $data = $kurikulum->toArray();
        $data['cover_foto_url'] = $kurikulum->cover_foto ? url('storage/' . $kurikulum->cover_foto) : null;

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil diperbarui',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kurikulum = Kurikulum::find($id);
        
        if (!$kurikulum) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }

        // Delete cover_foto if exists
        if ($kurikulum->cover_foto) {
            \Storage::disk('public')->delete($kurikulum->cover_foto);
        }

        $kurikulum->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil dihapus'
        ]);
    }

    /**
     * Get kurikulum by semester
     */
    public function bySemester($semester)
    {
        $kurikulum = Kurikulum::where('semester', $semester)
            ->orderBy('kode_matkul', 'asc')
            ->get();

        $kurikulum->transform(function ($item) {
            $data = $item->toArray();
            $data['cover_foto_url'] = $item->cover_foto ? url('storage/' . $item->cover_foto) : null;
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $kurikulum,
            'message' => "Data kurikulum semester {$semester} berhasil diambil"
        ]);
    }

    /**
     * Get statistics
     */
    public function statistics()
    {
        $stats = [
            'total_matkul' => Kurikulum::count(),
            'total_sks' => Kurikulum::sum('sks'),
            'by_semester' => Kurikulum::selectRaw('semester, COUNT(*) as total_matkul, SUM(sks) as total_sks')
                ->groupBy('semester')
                ->orderBy('semester')
                ->get()
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
            'message' => 'Statistik kurikulum berhasil diambil'
        ]);
    }
}
