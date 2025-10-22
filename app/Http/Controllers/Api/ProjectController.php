<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all()->map(function ($item) {
            $data = $item->toArray();
            $data['foto_utama_url'] = $item->path_foto_utama ? url('storage/' . $item->path_foto_utama) : null;
            $data['galeri_urls'] = [];
            if ($item->path_foto_galeri) {
                $galeri = explode(',', $item->path_foto_galeri);
                foreach ($galeri as $path) {
                    $data['galeri_urls'][] = url('storage/' . trim($path));
                }
            }
            return $data;
        });

        return response()->json($projects);
    }

    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $data = $project->toArray();
        $data['foto_utama_url'] = $project->path_foto_utama ? url('storage/' . $project->path_foto_utama) : null;
        $data['galeri_urls'] = [];
        if ($project->path_foto_galeri) {
            $galeri = explode(',', $project->path_foto_galeri);
            foreach ($galeri as $path) {
                $data['galeri_urls'][] = url('storage/' . trim($path));
            }
        }

        return response()->json($data);
    }
}