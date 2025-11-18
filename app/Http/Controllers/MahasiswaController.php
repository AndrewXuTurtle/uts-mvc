<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'aktif'); // Default tab: aktif
        
        $query = Mahasiswa::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // Filter based on tab
        if ($tab === 'aktif') {
            $query->where('status', 'Aktif');
        } elseif ($tab === 'eligible') {
            // Mahasiswa yang eligible untuk lulus (tahun masuk + 4 <= tahun sekarang)
            $currentYear = date('Y');
            $query->where('status', 'Aktif')
                  ->whereRaw('tahun_masuk + 4 <= ?', [$currentYear]);
        } elseif ($tab === 'lulus') {
            $query->where('status', 'Lulus');
        }

        $mahasiswa = $query->orderBy('tahun_masuk', 'desc')->orderBy('nama')->paginate(15);

        // Count for badges
        $countAktif = Mahasiswa::where('status', 'Aktif')->count();
        $currentYear = date('Y');
        $countEligible = Mahasiswa::where('status', 'Aktif')
            ->whereRaw('tahun_masuk + 4 <= ?', [$currentYear])
            ->count();
        $countLulus = Mahasiswa::where('status', 'Lulus')->count();

        return view('mahasiswa.index', compact('mahasiswa', 'tab', 'countAktif', 'countEligible', 'countLulus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mahasiswa,email',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tahun_masuk' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'kelas' => 'nullable|string|max:10',
            'status' => 'required|in:Aktif,Lulus,Cuti,DO',
            'prodi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['nim', 'nama', 'email', 'no_hp', 'jenis_kelamin', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'tahun_masuk', 'kelas', 'status', 'prodi']);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $data['foto'] = Mahasiswa::uploadFoto($request->file('foto'));
        }

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:mahasiswa,email,' . $mahasiswa->id,
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tahun_masuk' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'kelas' => 'nullable|string|max:10',
            'status' => 'required|in:Aktif,Lulus,Cuti,DO',
            'prodi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['nim', 'nama', 'email', 'no_hp', 'jenis_kelamin', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'tahun_masuk', 'kelas', 'status', 'prodi']);

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }
            $data['foto'] = Mahasiswa::uploadFoto($request->file('foto'));
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.show', $mahasiswa)
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // Delete foto if exists
        if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * Convert mahasiswa to alumni
     */
    public function convertToAlumni($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Check if already has alumni record
        if ($mahasiswa->alumni) {
            return redirect()->back()->with('error', 'Mahasiswa ini sudah terdaftar sebagai alumni!');
        }

        // Update mahasiswa status to Lulus
        $mahasiswa->update([
            'status' => 'Lulus',
            'tahun_lulus' => date('Y')
        ]);

        // Create alumni record
        \App\Models\Alumni::create([
            'nim' => $mahasiswa->nim,
            'status_data' => 'Belum Lengkap'
        ]);

        return redirect()->route('alumni.index')
            ->with('success', "Mahasiswa {$mahasiswa->nama} berhasil dikonversi menjadi alumni! Silakan lengkapi data alumni.");
    }

    /**
     * Show eligible graduates (mahasiswa yang sudah waktunya lulus)
     */
    public function eligibleGraduates()
    {
        $mahasiswa = Mahasiswa::where('status', 'Aktif')
            ->get()
            ->filter(function($m) {
                return $m->isEligibleForGraduation();
            });

        return view('mahasiswa.eligible-graduates', compact('mahasiswa'));
    }
}