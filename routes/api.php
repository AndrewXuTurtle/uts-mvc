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