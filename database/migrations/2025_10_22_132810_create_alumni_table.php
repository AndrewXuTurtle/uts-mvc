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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('program_studi');
            $table->year('tahun_lulus');
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('foto')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('linkedin')->nullable();
            
            // Data Pekerjaan
            $table->string('pekerjaan_sekarang')->nullable(); // e.g., Bekerja, Wirausaha, Melanjutkan Studi
            $table->string('nama_perusahaan')->nullable();
            $table->string('posisi')->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->date('tanggal_mulai_kerja')->nullable();
            $table->decimal('gaji_range', 15, 2)->nullable(); // Optional salary range
            
            // Testimoni & Pencapaian
            $table->text('testimoni')->nullable();
            $table->text('pencapaian')->nullable(); // Achievements after graduation
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
