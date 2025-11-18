<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Agenda::query();

        // Filter by aktif status
        if ($request->has('aktif')) {
            $query->where('aktif', $request->aktif);
        }

        // Filter by kategori
        if ($request->has('kategori')) {
            $query->kategori($request->kategori);
        }

        // Filter agenda mendatang
        if ($request->has('mendatang') && $request->mendatang) {
            $query->mendatang();
        }

        // Filter by date range
        if ($request->has('tanggal_dari')) {
            $query->where('tanggal_mulai', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai')) {
            $query->where('tanggal_mulai', '<=', $request->tanggal_sampai);
        }

        // Search by title
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $agenda = $query->latest('tanggal_mulai')->paginate($perPage);

        // Add full image URL
        $agenda->getCollection()->transform(function ($item) {
            $data = $item->toArray();
            $data['gambar_url'] = $item->gambar ? url('storage/' . $item->gambar) : null;
            return $data;
        });

        return response()->json([
            'success' => true,
            'data' => $agenda
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'kategori' => 'required|in:seminar,workshop,rapat,acara,lainnya',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = Agenda::uploadGambar($request->file('gambar'));
        }

        $agenda = Agenda::create($validated);

        $data = $agenda->toArray();
        $data['gambar_url'] = $agenda->gambar ? url('storage/' . $agenda->gambar) : null;

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agenda = Agenda::find($id);
        
        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan'
            ], 404);
        }

        $data = $agenda->toArray();
        $data['gambar_url'] = $agenda->gambar ? url('storage/' . $agenda->gambar) : null;

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
        $agenda = Agenda::find($id);
        
        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'penyelenggara' => 'nullable|string|max:255',
            'kategori' => 'required|in:seminar,workshop,rapat,acara,lainnya',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'aktif' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($agenda->gambar) {
                Storage::disk('public')->delete($agenda->gambar);
            }
            $validated['gambar'] = Agenda::uploadGambar($request->file('gambar'));
        }

        $agenda->update($validated);

        $data = $agenda->toArray();
        $data['gambar_url'] = $agenda->gambar ? url('storage/' . $agenda->gambar) : null;

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil diperbarui',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agenda = Agenda::find($id);
        
        if (!$agenda) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan'
            ], 404);
        }

        // Delete image file
        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dihapus'
        ]);
    }
}
