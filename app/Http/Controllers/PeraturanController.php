<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peraturan::query();

        // Filter by kategori
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->kategori($request->kategori);
        }

        // Filter by jenis
        if ($request->has('jenis') && !empty($request->jenis)) {
            $query->jenis($request->jenis);
        }

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        $peraturan = $query->ordered()->paginate(15);

        $kategoriList = ['Akademik', 'Kemahasiswaan', 'Administratif', 'Keuangan'];
        
        return view('peraturan.index', compact('peraturan', 'kategoriList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriList = ['Akademik', 'Kemahasiswaan', 'Administratif', 'Keuangan'];
        $jenisOptions = $this->getJenisOptions();
        
        return view('peraturan.create', compact('kategoriList', 'jenisOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:Akademik,Kemahasiswaan,Administratif,Keuangan',
            'jenis' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:10240', // Max 10MB
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($validated['judul']) . '.pdf';
            $filePath = $file->storeAs('peraturan', $fileName, 'public');

            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        $validated['is_active'] = $request->has('is_active');

        Peraturan::create($validated);

        return redirect()->route('peraturan.index')
            ->with('success', 'Peraturan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peraturan $peraturan)
    {
        return view('peraturan.show', compact('peraturan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peraturan $peraturan)
    {
        $kategoriList = ['Akademik', 'Kemahasiswaan', 'Administratif', 'Keuangan'];
        $jenisOptions = $this->getJenisOptions();
        
        return view('peraturan.edit', compact('peraturan', 'kategoriList', 'jenisOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peraturan $peraturan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:Akademik,Kemahasiswaan,Administratif,Keuangan',
            'jenis' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Upload new file if provided
        if ($request->hasFile('file')) {
            // Delete old file
            if ($peraturan->file_path && Storage::disk('public')->exists($peraturan->file_path)) {
                Storage::disk('public')->delete($peraturan->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . Str::slug($validated['judul']) . '.pdf';
            $filePath = $file->storeAs('peraturan', $fileName, 'public');

            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        $validated['is_active'] = $request->has('is_active');

        $peraturan->update($validated);

        return redirect()->route('peraturan.index')
            ->with('success', 'Peraturan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peraturan $peraturan)
    {
        // Delete file
        if ($peraturan->file_path && Storage::disk('public')->exists($peraturan->file_path)) {
            Storage::disk('public')->delete($peraturan->file_path);
        }

        $peraturan->delete();

        return redirect()->route('peraturan.index')
            ->with('success', 'Peraturan berhasil dihapus');
    }

    /**
     * Download peraturan file
     */
    public function download(Peraturan $peraturan)
    {
        if (!Storage::disk('public')->exists($peraturan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download(
            storage_path('app/public/' . $peraturan->file_path),
            $peraturan->file_name
        );
    }

    /**
     * Get jenis options based on kategori
     */
    private function getJenisOptions()
    {
        return [
            'Akademik' => ['Kalender Akademik', 'Panduan Studi', 'Skripsi', 'Magang'],
            'Kemahasiswaan' => ['Tata Tertib', 'Kode Etik', 'Kegiatan'],
            'Administratif' => ['SOP', 'Surat Menyurat', 'Cuti Kuliah'],
            'Keuangan' => ['Biaya Kuliah', 'Beasiswa', 'Denda Keterlambatan'],
        ];
    }
}
