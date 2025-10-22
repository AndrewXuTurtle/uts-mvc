<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;  // Add this import

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all()->map(function ($item) {
            $data = $item->toArray();
            $data['foto_url'] = $item->foto ? url('storage/' . $item->foto) : null;
            return $data;
        });

        return response()->json($dosen);
    }

    public function show($id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json(['message' => 'Dosen not found'], 404);
        }

        $data = $dosen->toArray();
        $data['foto_url'] = $dosen->foto ? url('storage/' . $dosen->foto) : null;

        return response()->json($data);
    }

    // Add other methods as needed (store, show, update, destroy)
}
