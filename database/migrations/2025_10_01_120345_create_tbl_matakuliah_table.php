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
        Schema::create('tbl_matakuliah', function (Blueprint $table) {
            $table->id('mk_id');
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester');
            $table->string('program_studi');
            $table->year('kurikulum_tahun');
            $table->text('deskripsi_singkat')->nullable();
            $table->enum('status_wajib', ['wajib', 'pilihan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_matakuliah');
    }
};
