<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alumni::with('mahasiswa');

        // Filter berdasarkan tahun lulus
        if ($request->filled('tahun_lulus')) {
            $query->where('tahun_lulus', $request->tahun_lulus);
        }

        // Search by nama mahasiswa or nim
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $alumni = $query->orderBy('tahun_lulus', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        // Get unique years for filter
        $tahunList = Alumni::selectRaw('DISTINCT tahun_lulus')
                           ->whereNotNull('tahun_lulus')
                           ->orderBy('tahun_lulus', 'desc')
                           ->pluck('tahun_lulus');

        return view('alumni.index', compact('alumni', 'tahunList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get mahasiswa yang sudah lulus tapi belum jadi alumni
        $mahasiswaLulus = Mahasiswa::where('status', 'Lulus')
            ->whereNotIn('nim', function($query) {
                $query->select('nim')->from('alumni');
            })
            ->orderBy('nama')
            ->get();

        return view('alumni.create', compact('mahasiswaLulus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|exists:mahasiswa,nim|unique:alumni,nim',
            'tahun_lulus' => 'required|integer|min:2000|max:' . (date('Y') + 10),
        ]);

        Alumni::create($validated);

        return redirect()->route('alumni.index')->with('success', 'Alumni berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumni = Alumni::with(['mahasiswa', 'kisahSukses', 'tracerStudies'])->findOrFail($id);
        return view('alumni.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumni = Alumni::with('mahasiswa')->findOrFail($id);
        return view('alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'tahun_lulus' => 'required|integer|min:2000|max:' . (date('Y') + 10),
        ]);

        $alumni->update($validated);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus!');
    }
    
    /**
     * Auto create alumni from mahasiswa with status "Lulus"
     */
    public function syncFromMahasiswa()
    {
        $mahasiswaLulus = Mahasiswa::where('status', 'Lulus')
            ->whereNotIn('nim', function($query) {
                $query->select('nim')->from('alumni');
            })
            ->get();

        $count = 0;
        foreach ($mahasiswaLulus as $mhs) {
            Alumni::create([
                'nim' => $mhs->nim,
                'tahun_lulus' => $mhs->tahun_lulus ?? date('Y'),
            ]);
            $count++;
        }

        return redirect()->route('alumni.index')
            ->with('success', "Berhasil menambahkan {$count} alumni dari data mahasiswa!");
    }
}
