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
            $table->string('nim', 20)->unique();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            
            // Data tambahan alumni
            $table->string('pekerjaan_saat_ini')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('posisi_jabatan')->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->string('no_hp_perusahaan', 20)->nullable();
            $table->decimal('gaji_pertama', 15, 2)->nullable();
            $table->decimal('gaji_saat_ini', 15, 2)->nullable();
            
            // Waktu tunggu pekerjaan (dalam bulan)
            $table->integer('waktu_tunggu_pekerjaan')->nullable()->comment('Dalam bulan');
            
            // Kesesuaian pekerjaan dengan bidang studi
            $table->enum('kesesuaian_bidang', [
                'Sangat Sesuai',
                'Sesuai', 
                'Cukup Sesuai',
                'Kurang Sesuai',
                'Tidak Sesuai'
            ])->nullable();
            
            // Status kelengkapan data
            $table->enum('status_data', ['Lengkap', 'Belum Lengkap'])->default('Belum Lengkap');
            
            // Sosial media
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            
            // Pesan alumni
            $table->text('pesan_alumni')->nullable();
            $table->string('foto_alumni')->nullable();
            
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
