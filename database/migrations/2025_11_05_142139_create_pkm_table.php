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
        Schema::create('pkm', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pkm');
            $table->text('deskripsi');
            $table->year('tahun');
            $table->enum('jenis_pkm', [
                'PKM-R', // Riset
                'PKM-K', // Kewirausahaan
                'PKM-M', // Pengabdian Masyarakat
                'PKM-T', // Karsa Cipta
                'PKM-KC', // Karya Inovatif
                'PKM-AI', // Artikel Ilmiah
                'PKM-GT'  // Gagasan Tertulis
            ]);
            $table->string('status')->default('Proposal'); // Proposal, Didanai, Selesai, Ditolak
            $table->decimal('dana', 15, 2)->nullable();
            $table->string('pencapaian')->nullable(); // Lolos Dikti, Juara 1, dll
            $table->string('file_dokumen')->nullable();
            $table->foreignId('dosen_pembimbing_id')->nullable()->constrained('dosen')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkm');
    }
};
