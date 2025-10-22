<?php

use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\MatakuliahController;
use App\Http\Controllers\Api\ProfilProdiController;
use Illuminate\Support\Facades\Route;

Route::apiResource('dosen', DosenController::class);
Route::apiResource('project', ProjectController::class);
Route::apiResource('matakuliah', MatakuliahController::class);
Route::apiResource('profil-prodi', ProfilProdiController::class);

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