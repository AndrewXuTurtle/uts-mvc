<?php

namespace App\Http\Controllers;

use App\Models\PKM;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PKM::with(['dosen', 'mahasiswa']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('mitra', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by tahun
        if ($request->has('tahun') && !empty($request->tahun)) {
            $query->where('tahun', $request->tahun);
        }

        // Filter by dosen
        if ($request->has('dosen_id') && !empty($request->dosen_id)) {
            $query->dosen($request->dosen_id);
        }

        // Filter by mahasiswa
        if ($request->has('mahasiswa_id') && !empty($request->mahasiswa_id)) {
            $query->mahasiswa($request->mahasiswa_id);
        }

        $pkm = $query->orderBy('tahun', 'desc')->orderBy('judul_pkm')->paginate(10);

        // Get filter options
        $statusList = ['ongoing' => 'Sedang Berlangsung', 'completed' => 'Selesai', 'published' => 'Dipublikasikan', 'cancelled' => 'Dibatalkan'];
        $tahunList = PKM::distinct()->pluck('tahun')->sort()->reverse();
        $dosenList = Dosen::orderBy('nama')->get();
        $mahasiswaList = Mahasiswa::orderBy('nama')->get();

        return view('pkm.index', compact('pkm', 'statusList', 'tahunList', 'dosenList', 'mahasiswaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::orderBy('nama')->get();
        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        return view('pkm.create', compact('dosen', 'mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_id' => 'required|array|min:1',
            'dosen_id.*' => 'exists:dosen,id',
            'mahasiswa_id' => 'required|array|min:1',
            'mahasiswa_id.*' => 'exists:tbl_mahasiswa,id',
            'mitra' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:ongoing,completed,published,cancelled',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'judul', 'deskripsi', 'mitra',
            'lokasi', 'biaya', 'status', 'tahun', 'tanggal_mulai', 'tanggal_selesai'
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = PKM::uploadDokumentasi($request->file('dokumentasi'));
        }

        $pkm = PKM::create($data);

        // Sync many-to-many relationships
        $pkm->dosen()->sync($request->dosen_id);
        $pkm->mahasiswa()->sync($request->mahasiswa_id);

        return redirect()->route('pkm.index')
            ->with('success', 'Data PKM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PKM $pkm)
    {
        $pkm->load(['dosen', 'mahasiswa']);
        return view('pkm.show', compact('pkm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PKM $pkm)
    {
        $dosen = Dosen::orderBy('nama')->get();
        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        return view('pkm.edit', compact('pkm', 'dosen', 'mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PKM $pkm)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'dosen_id' => 'required|array|min:1',
            'dosen_id.*' => 'exists:dosen,id',
            'mahasiswa_id' => 'required|array|min:1',
            'mahasiswa_id.*' => 'exists:tbl_mahasiswa,id',
            'mitra' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:ongoing,completed,published,cancelled',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'judul', 'deskripsi', 'mitra',
            'lokasi', 'biaya', 'status', 'tahun', 'tanggal_mulai', 'tanggal_selesai'
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('dokumentasi')) {
            // Delete old images if they exist
            if ($pkm->dokumentasi) {
                foreach ($pkm->dokumentasi as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
            $data['dokumentasi'] = PKM::uploadDokumentasi($request->file('dokumentasi'));
        }

        $pkm->update($data);

        // Sync many-to-many relationships
        $pkm->dosen()->sync($request->dosen_id);
        $pkm->mahasiswa()->sync($request->mahasiswa_id);

        return redirect()->route('pkm.show', $pkm)
            ->with('success', 'Data PKM berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PKM $pkm)
    {
        // Delete dokumentasi images if they exist
        if ($pkm->dokumentasi) {
            foreach ($pkm->dokumentasi as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $pkm->delete();

        return redirect()->route('pkm.index')
            ->with('success', 'Data PKM berhasil dihapus.');
    }
}
