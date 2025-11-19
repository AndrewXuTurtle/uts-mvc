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
        Schema::table('alumni', function (Blueprint $table) {
            // Drop all unnecessary columns
            $table->dropColumn([
                'pekerjaan_saat_ini',
                'nama_perusahaan',
                'posisi_jabatan',
                'alamat_perusahaan',
                'no_hp_perusahaan',
                'gaji_pertama',
                'gaji_saat_ini',
                'waktu_tunggu_pekerjaan',
                'kesesuaian_bidang',
                'status_data',
                'linkedin',
                'instagram',
                'facebook',
                'pesan_alumni',
                'foto_alumni',
            ]);
            
            // Add tahun_lulus
            $table->year('tahun_lulus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            // Restore columns if needed to rollback
            $table->string('pekerjaan_saat_ini')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('posisi_jabatan')->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->string('no_hp_perusahaan', 20)->nullable();
            $table->decimal('gaji_pertama', 15, 2)->nullable();
            $table->decimal('gaji_saat_ini', 15, 2)->nullable();
            $table->integer('waktu_tunggu_pekerjaan')->nullable();
            $table->enum('kesesuaian_bidang', [
                'Sangat Sesuai',
                'Sesuai', 
                'Cukup Sesuai',
                'Kurang Sesuai',
                'Tidak Sesuai'
            ])->nullable();
            $table->enum('status_data', ['Lengkap', 'Belum Lengkap'])->default('Belum Lengkap');
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->text('pesan_alumni')->nullable();
            $table->string('foto_alumni')->nullable();
            
            $table->dropColumn('tahun_lulus');
        });
    }
};
