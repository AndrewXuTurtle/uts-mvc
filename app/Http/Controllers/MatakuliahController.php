<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $matakuliah = Matakuliah::query()
            ->search($request->search)
            ->filterSemester($request->semester)
            ->filterKurikulumTahun($request->kurikulum_tahun)
            ->latest()
            ->paginate(10);

        $semester = Matakuliah::distinct()->pluck('semester')->sort();
        $kurikulum_tahun = Matakuliah::distinct()->pluck('kurikulum_tahun')->sort()->reverse();

        return view('matakuliah.index', compact('matakuliah', 'semester', 'kurikulum_tahun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|unique:matakuliah,kode_mk',
            'nama_mk' => 'required',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'program_studi' => 'required',
            'kurikulum_tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'deskripsi_singkat' => 'nullable',
            'status_wajib' => 'required|in:Wajib,Pilihan,1,0',
        ]);

        // Convert Wajib/Pilihan to boolean
        if (isset($validated['status_wajib'])) {
            $validated['status_wajib'] = ($validated['status_wajib'] === 'Wajib' || $validated['status_wajib'] === '1' || $validated['status_wajib'] === 1) ? 1 : 0;
        }

        Matakuliah::create($validated);

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matakuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $validated = $request->validate([
            'kode_mk' => 'required|unique:matakuliah,kode_mk,' . $matakuliah->mk_id . ',mk_id',
            'nama_mk' => 'required',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'program_studi' => 'required',
            'kurikulum_tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'deskripsi_singkat' => 'nullable',
            'status_wajib' => 'required|in:Wajib,Pilihan,1,0',
        ]);

        // Convert Wajib/Pilihan to boolean
        if (isset($validated['status_wajib'])) {
            $validated['status_wajib'] = ($validated['status_wajib'] === 'Wajib' || $validated['status_wajib'] === '1' || $validated['status_wajib'] === 1) ? 1 : 0;
        }

        $matakuliah->update($validated);

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus');
    }
}
