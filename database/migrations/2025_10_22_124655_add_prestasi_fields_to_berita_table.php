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
        Schema::table('berita', function (Blueprint $table) {
            $table->boolean('is_prestasi')->default(false)->after('tanggal');
            $table->string('nama_mahasiswa')->nullable()->after('is_prestasi');
            $table->string('nim')->nullable()->after('nama_mahasiswa');
            $table->string('program_studi')->nullable()->after('nim');
            $table->string('tingkat_prestasi')->nullable()->after('program_studi'); // Internasional, Nasional, Regional, Lokal
            $table->string('jenis_prestasi')->nullable()->after('tingkat_prestasi'); // Akademik, Non-Akademik, Olahraga, Seni, dll
            $table->string('penyelenggara')->nullable()->after('jenis_prestasi');
            $table->date('tanggal_prestasi')->nullable()->after('penyelenggara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn([
                'is_prestasi',
                'nama_mahasiswa',
                'nim',
                'program_studi',
                'tingkat_prestasi',
                'jenis_prestasi',
                'penyelenggara',
                'tanggal_prestasi'
            ]);
        });
    }
};
