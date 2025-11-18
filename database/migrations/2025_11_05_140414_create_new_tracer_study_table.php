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
        Schema::create('tracer_study', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20);
            $table->foreign('nim')->references('nim')->on('alumni')->onDelete('cascade');
            
            $table->year('tahun_survey');
            
            // Status pekerjaan
            $table->enum('status_pekerjaan', [
                'Bekerja Full Time',
                'Bekerja Part Time',
                'Wiraswasta',
                'Melanjutkan Studi',
                'Belum Bekerja',
                'Freelancer'
            ]);
            
            // Jika bekerja
            $table->string('nama_perusahaan')->nullable();
            $table->string('posisi')->nullable();
            $table->string('bidang_pekerjaan')->nullable();
            $table->decimal('gaji', 15, 2)->nullable();
            
            // Waktu tunggu pekerjaan (bulan)
            $table->integer('waktu_tunggu_kerja')->nullable()->comment('Dalam bulan');
            
            // Kesesuaian pekerjaan
            $table->enum('kesesuaian_bidang_studi', [
                'Sangat Sesuai',
                'Sesuai',
                'Cukup Sesuai',
                'Kurang Sesuai',
                'Tidak Sesuai'
            ])->nullable();
            
            // Kepuasan terhadap program studi (1-5)
            $table->integer('kepuasan_prodi')->nullable();
            $table->text('saran_prodi')->nullable();
            
            // Kompetensi yang didapat
            $table->text('kompetensi_didapat')->nullable();
            $table->text('saran_pengembangan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_study');
    }
};
