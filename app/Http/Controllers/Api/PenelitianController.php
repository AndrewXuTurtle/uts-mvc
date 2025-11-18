<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Eager load dosen relationship
        $query = Penelitian::with('dosen');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Filter berdasarkan dosen
        if ($request->filled('dosen_id')) {
            $query->where('ketua_peneliti_id', $request->dosen_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('bidang_penelitian', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort_by', 'tahun');
        $sortOrder = $request->get('sort_order', 'desc');

        $penelitian = $query->orderBy($sortBy, $sortOrder)
                           ->paginate($request->get('per_page', 12));

        // Transform to include flattened dosen data
        $penelitian->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul_penelitian,
                'deskripsi' => $item->deskripsi,
                'ketua_peneliti_id' => $item->ketua_peneliti_id,
                // Flatten dosen data
                'dosen' => [
                    'id' => $item->dosen->id ?? null,
                    'nidn' => $item->dosen->nidn ?? null,
                    'nama' => $item->dosen->nama ?? 'N/A',
                    'email' => $item->dosen->email ?? null,
                    'jabatan' => $item->dosen->jabatan ?? null,
                    'bidang_keahlian' => $item->dosen->bidang_keahlian ?? null,
                ],
                'tahun' => $item->tahun,
                'status' => $item->status,
                'bidang_penelitian' => $item->bidang_penelitian,
                'sumber_dana' => $item->sumber_dana,
                'jumlah_dana' => $item->dana,
                'tanggal_mulai' => $item->tanggal_mulai,
                'tanggal_selesai' => $item->tanggal_selesai,
                'file_proposal' => $item->file_dokumen,
                'file_proposal_url' => $item->file_dokumen ? asset('storage/' . $item->file_dokumen) : null,
                'file_laporan' => null,
                'file_laporan_url' => null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $penelitian
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ketua_peneliti_id' => 'required|exists:tbl_dosen,id',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:Draft,Sedang Berjalan,Selesai',
            'jenis_penelitian' => 'nullable|string|max:255',
            'sumber_dana' => 'nullable|string|max:255',
            'dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'output' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Handle file uploads
        if ($request->hasFile('file_dokumen')) {
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('penelitian/dokumen', 'public');
        }

        $penelitian = Penelitian::create($validated);

        // Load relationship
        $penelitian->load('dosen:id,nama,nidn');

        // Add file URLs
        $penelitian->file_dokumen_url = $penelitian->file_dokumen ? asset('storage/' . $penelitian->file_dokumen) : null;

        return response()->json([
            'success' => true,
            'message' => 'Data penelitian berhasil ditambahkan',
            'data' => $penelitian
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penelitian = Penelitian::with('dosen')->findOrFail($id);

        $data = [
            'id' => $penelitian->id,
            'judul' => $penelitian->judul_penelitian,
            'deskripsi' => $penelitian->deskripsi,
            'ketua_peneliti_id' => $penelitian->ketua_peneliti_id,
            // Complete dosen data
            'dosen' => [
                'id' => $penelitian->dosen->id ?? null,
                'nidn' => $penelitian->dosen->nidn ?? null,
                'nama' => $penelitian->dosen->nama ?? 'N/A',
                'email' => $penelitian->dosen->email ?? null,
                'no_hp' => $penelitian->dosen->no_hp ?? null,
                'jabatan' => $penelitian->dosen->jabatan ?? null,
                'pendidikan_terakhir' => $penelitian->dosen->pendidikan_terakhir ?? null,
                'bidang_keahlian' => $penelitian->dosen->bidang_keahlian ?? null,
            ],
            'tahun' => $penelitian->tahun,
            'status' => $penelitian->status,
            'jenis_penelitian' => $penelitian->jenis_penelitian,
            'sumber_dana' => $penelitian->sumber_dana,
            'jumlah_dana' => $penelitian->dana,
            'tanggal_mulai' => $penelitian->tanggal_mulai,
            'tanggal_selesai' => $penelitian->tanggal_selesai,
            'output' => $penelitian->output,
            'file_dokumen' => $penelitian->file_dokumen,
            'file_dokumen_url' => $penelitian->file_dokumen ? asset('storage/' . $penelitian->file_dokumen) : null,
            'created_at' => $penelitian->created_at,
            'updated_at' => $penelitian->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penelitian = Penelitian::findOrFail($id);

        $validated = $request->validate([
            'judul_penelitian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ketua_peneliti_id' => 'required|exists:tbl_dosen,id',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:Draft,Sedang Berjalan,Selesai',
            'jenis_penelitian' => 'nullable|string|max:255',
            'sumber_dana' => 'nullable|string|max:255',
            'dana' => 'nullable|numeric|min:0',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'output' => 'nullable|string',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB
        ]);

        // Handle file uploads
        if ($request->hasFile('file_dokumen')) {
            // Delete old file if exists
            if ($penelitian->file_dokumen) {
                Storage::disk('public')->delete($penelitian->file_dokumen);
            }
            $validated['file_dokumen'] = $request->file('file_dokumen')->store('penelitian/dokumen', 'public');
        }

        $penelitian->update($validated);

        // Load relationship
        $penelitian->load('dosen:id,nama,nidn');

        // Add file URLs
        $penelitian->file_dokumen_url = $penelitian->file_dokumen ? asset('storage/' . $penelitian->file_dokumen) : null;

        return response()->json([
            'success' => true,
            'message' => 'Data penelitian berhasil diupdate',
            'data' => $penelitian
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penelitian = Penelitian::findOrFail($id);

        // Delete associated files
        if ($penelitian->file_dokumen) {
            Storage::disk('public')->delete($penelitian->file_dokumen);
        }

        $penelitian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data penelitian berhasil dihapus'
        ]);
    }

    /**
     * Get penelitian by dosen
     */
    public function byDosen($dosenId)
    {
        $penelitian = Penelitian::with('dosen')
            ->where('ketua_peneliti_id', $dosenId)
            ->orderBy('tahun', 'desc')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        // Transform to include dosen data
        $penelitian = $penelitian->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul_penelitian,
                'deskripsi' => $item->deskripsi,
                'dosen' => [
                    'id' => $item->dosen->id ?? null,
                    'nidn' => $item->dosen->nidn ?? null,
                    'nama' => $item->dosen->nama ?? 'N/A',
                    'jabatan' => $item->dosen->jabatan ?? null,
                ],
                'tahun' => $item->tahun,
                'status' => $item->status,
                'jenis_penelitian' => $item->jenis_penelitian,
                'sumber_dana' => $item->sumber_dana,
                'jumlah_dana' => $item->dana,
                'tanggal_mulai' => $item->tanggal_mulai,
                'tanggal_selesai' => $item->tanggal_selesai,
                'file_dokumen_url' => $item->file_dokumen ? asset('storage/' . $item->file_dokumen) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'dosen_id' => $dosenId,
            'total' => $penelitian->count(),
            'data' => $penelitian
        ]);
    }

    /**
     * Get penelitian statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => Penelitian::count(),
            'by_status' => Penelitian::selectRaw('status, COUNT(*) as total')
                ->groupBy('status')
                ->get()
                ->pluck('total', 'status'),
            'by_year' => Penelitian::selectRaw('tahun, COUNT(*) as total')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->get()
                ->pluck('total', 'tahun'),
            'total_funding' => Penelitian::whereNotNull('dana')->sum('dana'),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
