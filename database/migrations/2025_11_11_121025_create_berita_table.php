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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('gambar')->nullable();
            $table->string('penulis')->nullable();
            $table->date('tanggal');
            $table->boolean('is_prestasi')->default(false);
            $table->string('nama_mahasiswa')->nullable();
            $table->string('nim')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('tingkat_prestasi')->nullable();
            $table->string('jenis_prestasi')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->date('tanggal_prestasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
