<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::query()
            ->search($request->search)
            ->filterTahun($request->tahun)
            ->latest()
            ->paginate(10);

        $tahun = Project::distinct()->pluck('tahun_selesai')->sort()->reverse();

        return view('project.index', compact('projects', 'tahun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = \App\Models\Mahasiswa::orderBy('nama')->get();
        return view('project.create', compact('mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul_project' => 'required',
            'deskripsi' => 'nullable',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tahun_selesai' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'kategori' => 'nullable|string',
            'teknologi' => 'nullable|string',
            'dosen_pembimbing' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'galeri.*' => 'nullable|image|max:2048',
            'link_demo' => 'nullable|url',
            'link_github' => 'nullable|url',
            'status' => 'nullable|in:Draft,Published',
        ]);

        // Default status
        $validated['status'] = $validated['status'] ?? 'Published';

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = Project::uploadFoto($request->file('cover_image'));
        }

        if ($request->hasFile('galeri')) {
            $galeriPaths = [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = Project::uploadFoto($file);
            }
            $validated['galeri'] = $galeriPaths; // Will be cast to JSON by model
        }

        Project::create($validated);

        return redirect()->route('project.index')
            ->with('success', 'Data project berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul_project' => 'required',
            'deskripsi' => 'nullable',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tahun_selesai' => 'nullable|integer|min:2000|max:' . (date('Y') + 1),
            'kategori' => 'nullable|string',
            'teknologi' => 'nullable|string',
            'dosen_pembimbing' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
            'galeri.*' => 'nullable|image|max:2048',
            'link_demo' => 'nullable|url',
            'link_github' => 'nullable|url',
            'status' => 'nullable|in:Draft,Published',
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old photo
            if ($project->cover_image) {
                Storage::delete('public/' . $project->cover_image);
            }
            $validated['cover_image'] = Project::uploadFoto($request->file('cover_image'));
        }

        if ($request->hasFile('galeri')) {
            // Append new galeri photos to existing ones
            $galeriPaths = $project->galeri ?? [];
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = Project::uploadFoto($file);
            }
            $validated['galeri'] = $galeriPaths; // Will be cast to JSON by model
        }

        $project->update($validated);

        return redirect()->route('project.index')
            ->with('success', 'Data project berhasil diperbarui');
    }

    /**
     * Delete a specific gallery image from a project.
     */
    public function deleteGalleryImage(Project $project, Request $request)
    {
        $imagePath = $request->input('image_path');

        if ($project->galeri && $imagePath) {
            $galeriPaths = $project->galeri; // Already an array due to cast

            // Find and remove the specific image
            $key = array_search($imagePath, $galeriPaths);
            if ($key !== false) {
                // Delete the file from storage
                Storage::delete('public/' . $imagePath);

                // Remove from array
                unset($galeriPaths[$key]);

                // Update the project
                $project->update([
                    'galeri' => array_values($galeriPaths) // Re-index array
                ]);

                return response()->json(['success' => true, 'message' => 'Gambar galeri berhasil dihapus']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Gambar tidak ditemukan'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::delete('public/' . $project->cover_image);
        }
        if ($project->galeri) {
            foreach ($project->galeri as $path) {
                Storage::delete('public/' . $path);
            }
        }

        $project->delete();

        return redirect()->route('project.index')
            ->with('success', 'Data project berhasil dihapus');
    }
}
