<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MatakuliahController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('dosen', DosenController::class);
// Project routes
Route::resource('project', ProjectController::class);
Route::delete('project/{project}/gallery', [ProjectController::class, 'deleteGalleryImage'])->name('project.delete-gallery-image');

// Matakuliah routes
Route::resource('matakuliah', MatakuliahController::class);

// Profil Prodi routes
Route::resource('profil-prodi', App\Http\Controllers\ProfilProdiController::class);

// Profile page route
Route::get('/profil', function () {
    return view('profil');
})->name('profil');

// Kegiatan routes
Route::resource('kegiatan', App\Http\Controllers\KegiatanController::class);

// Galeri routes
Route::resource('galeri', App\Http\Controllers\GaleriController::class);

// Berita routes
Route::resource('berita', App\Http\Controllers\BeritaController::class);

// Pengumuman routes
Route::resource('pengumuman', App\Http\Controllers\PengumumanController::class);

// Agenda routes
Route::resource('agenda', App\Http\Controllers\AgendaController::class);

// Alumni routes
Route::resource('alumni', App\Http\Controllers\AlumniController::class);
