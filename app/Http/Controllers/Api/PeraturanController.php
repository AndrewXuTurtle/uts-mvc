<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    /**
     * Get all peraturan grouped by kategori
     */
    public function index(Request $request)
    {
        $query = Peraturan::query();

        // Filter aktif saja untuk API public
        if (!$request->has('include_inactive')) {
            $query->active();
        }

        // Filter by kategori
        if ($request->has('kategori')) {
            $query->kategori($request->kategori);
        }

        // Filter by jenis
        if ($request->has('jenis')) {
            $query->jenis($request->jenis);
        }

        $peraturan = $query->ordered()->get();

        // Group by kategori
        $grouped = $peraturan->groupBy('kategori')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'deskripsi' => $item->deskripsi,
                    'kategori' => $item->kategori,
                    'jenis' => $item->jenis,
                    'file_url' => url('storage/' . $item->file_path),
                    'file_name' => $item->file_name,
                    'file_size' => $item->file_size_formatted,
                    'urutan' => $item->urutan,
                    'is_active' => $item->is_active,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
        });

        return response()->json([
            'success' => true,
            'data' => $grouped
        ]);
    }

    /**
     * Get peraturan by kategori
     */
    public function byKategori($kategori)
    {
        $peraturan = Peraturan::active()
            ->kategori($kategori)
            ->ordered()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'deskripsi' => $item->deskripsi,
                    'kategori' => $item->kategori,
                    'jenis' => $item->jenis,
                    'file_url' => url('storage/' . $item->file_path),
                    'file_name' => $item->file_name,
                    'file_size' => $item->file_size_formatted,
                    'urutan' => $item->urutan,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });

        return response()->json([
            'success' => true,
            'kategori' => $kategori,
            'data' => $peraturan
        ]);
    }

    /**
     * Get single peraturan detail
     */
    public function show($id)
    {
        $peraturan = Peraturan::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $peraturan->id,
                'judul' => $peraturan->judul,
                'deskripsi' => $peraturan->deskripsi,
                'kategori' => $peraturan->kategori,
                'jenis' => $peraturan->jenis,
                'file_url' => url('storage/' . $peraturan->file_path),
                'file_name' => $peraturan->file_name,
                'file_size' => $peraturan->file_size_formatted,
                'urutan' => $peraturan->urutan,
                'is_active' => $peraturan->is_active,
                'created_at' => $peraturan->created_at,
                'updated_at' => $peraturan->updated_at,
            ]
        ]);
    }
}
