<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Eager load mahasiswa relationship
        $query = Project::with('mahasiswa');

        // Apply filters if provided
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_project', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'nim' => $item->nim,
                // Include mahasiswa data
                'mahasiswa' => [
                    'nim' => $item->mahasiswa->nim ?? null,
                    'nama' => $item->mahasiswa->nama ?? 'N/A',
                    'email' => $item->mahasiswa->email ?? null,
                    'kelas' => $item->mahasiswa->kelas ?? null,
                    'prodi' => $item->mahasiswa->prodi ?? null,
                ],
                // Project data
                'judul_project' => $item->judul_project,
                'deskripsi' => $item->deskripsi,
                'tahun' => $item->tahun,
                'tahun_selesai' => $item->tahun_selesai,
                'kategori' => $item->kategori,
                'teknologi' => $item->teknologi,
                'dosen_pembimbing' => $item->dosen_pembimbing,
                'link_github' => $item->link_github,
                'link_demo' => $item->link_demo,
                'status' => $item->status,
                // Image URLs
                'cover_image' => $item->cover_image,
                'cover_image_url' => $item->cover_image ? asset('storage/' . $item->cover_image) : null,
                'galeri' => $item->galeri ?? [],
                'galeri_urls' => collect($item->galeri ?? [])->map(function($path) {
                    return asset('storage/' . $path);
                })->toArray(),
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    public function show($id)
    {
        $project = Project::with('mahasiswa')->find($id);
        
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 404);
        }

        $data = [
            'id' => $project->id,
            'nim' => $project->nim,
            // Include complete mahasiswa data
            'mahasiswa' => [
                'nim' => $project->mahasiswa->nim ?? null,
                'nama' => $project->mahasiswa->nama ?? 'N/A',
                'email' => $project->mahasiswa->email ?? null,
                'no_hp' => $project->mahasiswa->no_hp ?? null,
                'kelas' => $project->mahasiswa->kelas ?? null,
                'prodi' => $project->mahasiswa->prodi ?? null,
                'tahun_masuk' => $project->mahasiswa->tahun_masuk ?? null,
            ],
            // Complete project data
            'judul_project' => $project->judul_project,
            'deskripsi' => $project->deskripsi,
            'tahun' => $project->tahun,
            'tahun_selesai' => $project->tahun_selesai,
            'kategori' => $project->kategori,
            'teknologi' => $project->teknologi,
            'dosen_pembimbing' => $project->dosen_pembimbing,
            'link_github' => $project->link_github,
            'link_demo' => $project->link_demo,
            'status' => $project->status,
            // Image URLs
            'cover_image' => $project->cover_image,
            'cover_image_url' => $project->cover_image ? asset('storage/' . $project->cover_image) : null,
            'galeri' => $project->galeri ?? [],
            'galeri_urls' => collect($project->galeri ?? [])->map(function($path) {
                return asset('storage/' . $path);
            })->toArray(),
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}