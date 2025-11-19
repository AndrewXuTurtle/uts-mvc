<?php

use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\MatakuliahController;
use App\Http\Controllers\Api\ProfilProdiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('dosen', DosenController::class);
Route::apiResource('mahasiswa', App\Http\Controllers\Api\MahasiswaController::class);
Route::apiResource('project', ProjectController::class);
Route::apiResource('matakuliah', MatakuliahController::class);
Route::apiResource('profil-prodi', ProfilProdiController::class);

// Kurikulum API
Route::apiResource('kurikulum', App\Http\Controllers\Api\KurikulumController::class);
Route::get('kurikulum-semester/{semester}', [App\Http\Controllers\Api\KurikulumController::class, 'bySemester']);
Route::get('kurikulum-statistics', [App\Http\Controllers\Api\KurikulumController::class, 'statistics']);

// Berita API
Route::apiResource('berita', App\Http\Controllers\Api\BeritaController::class);

// Pengumuman API
Route::apiResource('pengumuman', App\Http\Controllers\Api\PengumumanController::class);

// Agenda API
Route::apiResource('agenda', App\Http\Controllers\Api\AgendaController::class);

// Prestasi Mahasiswa API (khusus untuk halaman prestasi di Next.js)
Route::prefix('prestasi')->group(function () {
    Route::get('/', [App\Http\Controllers\Api\PrestasiController::class, 'index']);
    Route::get('/statistics', [App\Http\Controllers\Api\PrestasiController::class, 'statistics']);
    Route::get('/{id}', [App\Http\Controllers\Api\PrestasiController::class, 'show']);
});

// Alumni API
Route::apiResource('alumni', App\Http\Controllers\Api\AlumniController::class);
Route::get('alumni-statistics', [App\Http\Controllers\Api\AlumniController::class, 'statistics']);

// Galeri API
Route::apiResource('galeri', App\Http\Controllers\Api\GaleriController::class);
Route::get('galeri-kategori/{kategori}', [App\Http\Controllers\Api\GaleriController::class, 'byKategori']);

// Penelitian API
Route::apiResource('penelitian', App\Http\Controllers\Api\PenelitianController::class);
Route::get('penelitian-dosen/{dosenId}', [App\Http\Controllers\Api\PenelitianController::class, 'byDosen']);
Route::get('penelitian-statistics', [App\Http\Controllers\Api\PenelitianController::class, 'statistics']);

// PKM API
Route::apiResource('pkm', App\Http\Controllers\Api\PKMController::class);
Route::get('pkm-dosen/{dosenId}', [App\Http\Controllers\Api\PKMController::class, 'byDosen']);
Route::get('pkm-mahasiswa/{mahasiswaId}', [App\Http\Controllers\Api\PKMController::class, 'byMahasiswa']);
Route::get('pkm-statistics', [App\Http\Controllers\Api\PKMController::class, 'statistics']);

// Kisah Sukses API
Route::apiResource('kisah-sukses', App\Http\Controllers\Api\KisahSuksesController::class);
Route::get('kisah-sukses-featured', [App\Http\Controllers\Api\KisahSuksesController::class, 'featured']);
Route::get('kisah-sukses-statistics', [App\Http\Controllers\Api\KisahSuksesController::class, 'statistics']);

// Tracer Study API
Route::apiResource('tracer-study', App\Http\Controllers\Api\TracerStudyController::class);
Route::get('tracer-study-statistics', [App\Http\Controllers\Api\TracerStudyController::class, 'statistics']);
Route::get('tracer-study-testimonials', [App\Http\Controllers\Api\TracerStudyController::class, 'testimonials']);

// Peraturan API
Route::get('peraturan', [App\Http\Controllers\Api\PeraturanController::class, 'index']);
Route::get('peraturan/{id}', [App\Http\Controllers\Api\PeraturanController::class, 'show']);
Route::get('peraturan-kategori/{kategori}', [App\Http\Controllers\Api\PeraturanController::class, 'byKategori']);
