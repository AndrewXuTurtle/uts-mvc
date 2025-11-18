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
        Schema::create('penelitian', function (Blueprint $table) {
            $table->id();
            $table->string('judul_penelitian');
            $table->text('deskripsi');
            $table->year('tahun');
            $table->string('jenis_penelitian')->nullable(); // Mandiri, Hibah, Kolaborasi
            $table->string('sumber_dana')->nullable();
            $table->decimal('dana', 15, 2)->nullable();
            $table->string('status')->default('Sedang Berjalan'); // Draft, Sedang Berjalan, Selesai
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->text('output')->nullable(); // Jurnal, Prosiding, Paten, dll
            $table->string('file_dokumen')->nullable();
            $table->foreignId('ketua_peneliti_id')->nullable()->constrained('dosen')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitian');
    }
};
