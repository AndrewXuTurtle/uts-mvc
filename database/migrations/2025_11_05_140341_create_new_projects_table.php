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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20);
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            
            $table->string('judul_project');
            $table->text('deskripsi');
            $table->year('tahun');
            $table->year('tahun_selesai')->nullable();
            $table->string('kategori')->nullable();
            $table->string('teknologi')->nullable(); // Laravel, React, dll
            $table->string('dosen_pembimbing')->nullable();
            $table->string('cover_image')->nullable();
            $table->json('galeri')->nullable(); // Array of images
            $table->string('link_demo')->nullable();
            $table->string('link_github')->nullable();
            $table->enum('status', ['Draft', 'Published'])->default('Published');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
