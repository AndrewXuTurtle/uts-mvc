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
        Schema::create('tbl_profil_prodi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi')->default('Teknik Perangkat Lunak');
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('logo')->nullable();
            $table->string('kontak_email')->nullable();
            $table->string('kontak_telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_profil_prodi');
    }
};
