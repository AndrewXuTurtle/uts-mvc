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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp', 20)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->year('tahun_masuk');
            $table->string('kelas', 10)->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Aktif', 'Lulus', 'Cuti', 'DO'])->default('Aktif');
            $table->year('tahun_lulus')->nullable();
            $table->string('prodi')->default('Teknik Perangkat Lunak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
