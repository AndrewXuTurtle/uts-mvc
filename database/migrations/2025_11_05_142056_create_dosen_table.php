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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nidn', 20)->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp', 20)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('jabatan')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('bidang_keahlian')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->string('prodi')->default('Teknik Perangkat Lunak');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
