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
        Schema::create('pkm_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkm_id')->constrained('pkm')->onDelete('cascade');
            $table->string('nim', 20);
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->string('peran')->nullable(); // Ketua, Anggota
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkm_mahasiswa');
    }
};
