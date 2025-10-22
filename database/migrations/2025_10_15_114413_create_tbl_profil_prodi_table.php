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
            $table->string('nama_prodi', 150)->nullable(false);
            $table->text('visi')->nullable();
            $table->text('misi')->nullable(); // Fixed typo from "miS1" to "misi"
            $table->text('deskripsi')->nullable();
            $table->string('akreditasi', 10)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('kontak_email', 160)->nullable();
            $table->string('kontak_telepon', 20)->nullable();
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
