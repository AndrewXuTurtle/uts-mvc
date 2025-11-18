<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'lengkap'); // default: lengkap
        
        $query = Alumni::with('mahasiswa'); // eager load mahasiswa relation

        // Filter by tab (status_data)
        if ($tab === 'lengkap') {
            $query->lengkap();
        } elseif ($tab === 'belum_lengkap') {
            $query->belumLengkap();
        }

        // Filter berdasarkan tahun lulus
        if ($request->filled('tahun_lulus')) {
            $query->tahunLulus($request->tahun_lulus);
        }

        // Filter berdasarkan program studi
        if ($request->filled('program_studi')) {
            $query->programStudi($request->program_studi);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $alumni = $query->orderBy('created_at', 'desc')
                        ->paginate(15);

        // Count for badges
        $countLengkap = Alumni::lengkap()->count();
        $countBelumLengkap = Alumni::belumLengkap()->count();

        // Get unique years and program studi for filter (optional, jika masih digunakan)
        // $tahunList = Alumni::selectRaw('DISTINCT tahun_lulus')->orderBy('tahun_lulus', 'desc')->pluck('tahun_lulus');
        // $prodiList = Alumni::selectRaw('DISTINCT program_studi')->orderBy('program_studi')->pluck('program_studi');

        return view('alumni.index', compact('alumni', 'tab', 'countLengkap', 'countBelumLengkap'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:alumni,nim|max:255',
            'program_studi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'ipk' => 'nullable|numeric|min:0|max:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'pekerjaan_sekarang' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string',
            'tanggal_mulai_kerja' => 'nullable|date',
            'gaji_range' => 'nullable|numeric|min:0',
            'testimoni' => 'nullable|string',
            'pencapaian' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        Alumni::create($validated);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:alumni,nim,' . $id,
            'program_studi' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'ipk' => 'nullable|numeric|min:0|max:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'pekerjaan_sekarang' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string',
            'tanggal_mulai_kerja' => 'nullable|date',
            'gaji_range' => 'nullable|numeric|min:0',
            'testimoni' => 'nullable|string',
            'pencapaian' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }
            $validated['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumni->update($validated);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        // Delete foto if exists
        if ($alumni->foto) {
            Storage::disk('public')->delete($alumni->foto);
        }

        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus!');
    }
}
