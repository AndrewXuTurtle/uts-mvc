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
        // Rename tbl_matakuliah to matakuliah
        Schema::rename('tbl_matakuliah', 'matakuliah');
        
        // Rename tbl_profil_prodi to profil_prodi
        Schema::rename('tbl_profil_prodi', 'profil_prodi');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the renames
        Schema::rename('matakuliah', 'tbl_matakuliah');
        Schema::rename('profil_prodi', 'tbl_profil_prodi');
    }
};
