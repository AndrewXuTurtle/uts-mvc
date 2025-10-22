<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_project', function (Blueprint $table) {
            $table->id('project_id');
            $table->string('judul_proyek');
            $table->text('deskripsi_singkat');
            $table->string('nama_mahasiswa');
            $table->string('nim_mahasiswa');
            $table->string('program_studi');
            $table->string('dosen_pembimbing');
            $table->year('tahun_selesai');
            $table->string('path_foto_utama')->nullable();
            $table->json('path_foto_galeri')->nullable();
            $table->string('keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_project');
    }
};
