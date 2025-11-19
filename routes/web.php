<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MatakuliahController;

// Auth routes (public)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('dosen', DosenController::class);

// Mahasiswa routes
Route::resource('mahasiswa', MahasiswaController::class);
Route::post('mahasiswa/{mahasiswa}/convert-to-alumni', [MahasiswaController::class, 'convertToAlumni'])->name('mahasiswa.convert-to-alumni');

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

// Galeri routes
Route::resource('galeri', App\Http\Controllers\GaleriController::class);

// Penelitian routes
Route::resource('penelitian', App\Http\Controllers\PenelitianController::class);

// PKM routes
Route::resource('pkm', App\Http\Controllers\PKMController::class);

// Berita routes
Route::resource('berita', App\Http\Controllers\BeritaController::class);

// Pengumuman routes
Route::resource('pengumuman', App\Http\Controllers\PengumumanController::class);

// Agenda routes
Route::resource('agenda', App\Http\Controllers\AgendaController::class);

// Alumni routes
Route::get('alumni/sync', [App\Http\Controllers\AlumniController::class, 'syncFromMahasiswa'])->name('alumni.sync');
Route::resource('alumni', App\Http\Controllers\AlumniController::class);

// Kisah Sukses routes
Route::post('kisah-sukses/validate-nim', [App\Http\Controllers\KisahSuksesController::class, 'validateNim'])->name('kisah-sukses.validate-nim');
Route::resource('kisah-sukses', App\Http\Controllers\KisahSuksesController::class);

// Tracer Study routes
Route::post('tracer-study/validate-nim', [App\Http\Controllers\TracerStudyController::class, 'validateNim'])->name('tracer-study.validate-nim');
Route::resource('tracer-study', App\Http\Controllers\TracerStudyController::class);

// Peraturan routes
Route::get('peraturan/{peraturan}/download', [App\Http\Controllers\PeraturanController::class, 'download'])->name('peraturan.download');
Route::resource('peraturan', App\Http\Controllers\PeraturanController::class);

// User Management routes
Route::resource('users', App\Http\Controllers\UserController::class);
});
