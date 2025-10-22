<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::all();

        return response()->json($matakuliah);
    }

    public function show($id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah not found'], 404);
        }

        return response()->json($matakuliah);
    }
}