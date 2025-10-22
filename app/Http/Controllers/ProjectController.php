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
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_proyek' => 'required',
            'deskripsi_singkat' => 'nullable',
            'nama_mahasiswa' => 'required',
            'nim_mahasiswa' => 'required',
            'program_studi' => 'required',
            'dosen_pembimbing' => 'nullable',
            'tahun_selesai' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'path_foto_utama' => 'nullable|image|max:2048',
            'path_foto_galeri.*' => 'nullable|image|max:2048',
            'keywords' => 'nullable',
        ]);

        if ($request->hasFile('path_foto_utama')) {
            $validated['path_foto_utama'] = Project::uploadFoto($request->file('path_foto_utama'));
        }

        if ($request->hasFile('path_foto_galeri')) {
            $galeriPaths = [];
            foreach ($request->file('path_foto_galeri') as $file) {
                $galeriPaths[] = Project::uploadFoto($file);
            }
            $validated['path_foto_galeri'] = implode(',', $galeriPaths);
        } else {
            // Remove path_foto_galeri from validated data if no files uploaded
            // to prevent setting it to empty string which violates JSON constraint
            unset($validated['path_foto_galeri']);
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
            'judul_proyek' => 'required',
            'deskripsi_singkat' => 'nullable',
            'nama_mahasiswa' => 'required',
            'nim_mahasiswa' => 'required',
            'program_studi' => 'required',
            'dosen_pembimbing' => 'nullable',
            'tahun_selesai' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'path_foto_utama' => 'nullable|image|max:2048',
            'path_foto_galeri.*' => 'nullable|image|max:2048',
            'keywords' => 'nullable',
        ]);

        if ($request->hasFile('path_foto_utama')) {
            // Delete old photo
            if ($project->path_foto_utama) {
                Storage::delete('public/' . $project->path_foto_utama);
            }
            $validated['path_foto_utama'] = Project::uploadFoto($request->file('path_foto_utama'));
        }

        if ($request->hasFile('path_foto_galeri')) {
            // Append new galeri photos to existing ones
            $galeriPaths = [];
            if ($project->path_foto_galeri) {
                $galeriPaths = explode(',', $project->path_foto_galeri);
            }
            foreach ($request->file('path_foto_galeri') as $file) {
                $galeriPaths[] = Project::uploadFoto($file);
            }
            $validated['path_foto_galeri'] = implode(',', $galeriPaths);
        } else {
            // Remove path_foto_galeri from validated data if no files uploaded
            // to prevent setting it to empty string which violates JSON constraint
            unset($validated['path_foto_galeri']);
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

        if ($project->path_foto_galeri && $imagePath) {
            $galeriPaths = explode(',', $project->path_foto_galeri);
            $galeriPaths = array_map('trim', $galeriPaths);

            // Find and remove the specific image
            $key = array_search($imagePath, $galeriPaths);
            if ($key !== false) {
                // Delete the file from storage
                Storage::delete('public/' . $imagePath);

                // Remove from array
                unset($galeriPaths[$key]);

                // Update the project
                $project->update([
                    'path_foto_galeri' => implode(',', array_filter($galeriPaths))
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
        if ($project->path_foto_utama) {
            Storage::delete('public/' . $project->path_foto_utama);
        }
        if ($project->path_foto_galeri) {
            $galeri = explode(',', $project->path_foto_galeri);
            foreach ($galeri as $path) {
                Storage::delete('public/' . trim($path));
            }
        }

        $project->delete();

        return redirect()->route('project.index')
            ->with('success', 'Data project berhasil dihapus');
    }
}
