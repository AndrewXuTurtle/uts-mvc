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
        $query = Alumni::query();

        // Filter berdasarkan tahun lulus
        if ($request->filled('tahun_lulus')) {
            $query->tahunLulus($request->tahun_lulus);
        }

        // Filter berdasarkan program studi
        if ($request->filled('program_studi')) {
            $query->programStudi($request->program_studi);
        }

        // Filter berdasarkan status pekerjaan
        if ($request->filled('pekerjaan')) {
            $query->where('pekerjaan_sekarang', $request->pekerjaan);
        }

        // Filter yang sudah bekerja
        if ($request->filled('bekerja') && $request->bekerja == 'true') {
            $query->bekerja();
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'tahun_lulus');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $perPage = $request->input('per_page', 15);
        $alumni = $query->paginate($perPage);

        // Transform data untuk API response
        $alumni->getCollection()->transform(function ($item) {
            $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
            return $item;
        });

        return response()->json($alumni);
    }

    /**
     * Get statistics for alumni
     */
    public function statistics()
    {
        $stats = [
            'total_alumni' => Alumni::count(),
            'bekerja' => Alumni::where('pekerjaan_sekarang', 'Bekerja')->count(),
            'wirausaha' => Alumni::where('pekerjaan_sekarang', 'Wirausaha')->count(),
            'melanjutkan_studi' => Alumni::where('pekerjaan_sekarang', 'Melanjutkan Studi')->count(),
            'by_tahun' => Alumni::selectRaw('tahun_lulus, COUNT(*) as total')
                                ->groupBy('tahun_lulus')
                                ->orderBy('tahun_lulus', 'desc')
                                ->get(),
            'by_prodi' => Alumni::selectRaw('program_studi, COUNT(*) as total')
                                ->groupBy('program_studi')
                                ->orderBy('total', 'desc')
                                ->get(),
            'avg_ipk' => Alumni::avg('ipk'),
            'recent_alumni' => Alumni::with([])
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get()
                                    ->map(function ($item) {
                                        $item->foto_url = $item->foto ? asset('storage/' . $item->foto) : null;
                                        return $item;
                                    }),
        ];

        return response()->json($stats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:alumni,nim|max:255',
            'program_studi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'ipk' => 'nullable|numeric|min:0|max:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'pekerjaan_sekarang' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string',
            'tanggal_mulai_kerja' => 'nullable|date',
            'gaji_range' => 'nullable|numeric|min:0',
            'testimoni' => 'nullable|string',
            'pencapaian' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumni = Alumni::create($validated);
        $alumni->foto_url = $alumni->foto ? asset('storage/' . $alumni->foto) : null;

        return response()->json([
            'success' => true,
            'message' => 'Data alumni berhasil ditambahkan',
            'data' => $alumni
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->foto_url = $alumni->foto ? asset('storage/' . $alumni->foto) : null;

        return response()->json([
            'success' => true,
            'data' => $alumni
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:alumni,nim,' . $id,
            'program_studi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'ipk' => 'nullable|numeric|min:0|max:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'pekerjaan_sekarang' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string',
            'tanggal_mulai_kerja' => 'nullable|date',
            'gaji_range' => 'nullable|numeric|min:0',
            'testimoni' => 'nullable|string',
            'pencapaian' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }
            $validated['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumni->update($validated);
        $alumni->foto_url = $alumni->foto ? asset('storage/' . $alumni->foto) : null;

        return response()->json([
            'success' => true,
            'message' => 'Data alumni berhasil diupdate',
            'data' => $alumni
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        // Delete foto if exists
        if ($alumni->foto) {
            Storage::disk('public')->delete($alumni->foto);
        }

        $alumni->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data alumni berhasil dihapus'
        ]);
    }
}
