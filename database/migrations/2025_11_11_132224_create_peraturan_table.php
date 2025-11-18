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
        Schema::create('peraturan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['Akademik', 'Kemahasiswaan', 'Administratif', 'Keuangan']);
            $table->enum('jenis', [
                // Akademik
                'Kalender Akademik',
                'Panduan Studi',
                'Skripsi',
                'Magang',
                // Kemahasiswaan
                'Tata Tertib',
                'Kode Etik',
                'Kegiatan',
                // Administratif
                'SOP',
                'Surat Menyurat',
                'Cuti Kuliah',
                // Keuangan
                'Biaya Kuliah',
                'Beasiswa',
                'Denda Keterlambatan'
            ]);
            $table->string('file_path'); // Path to PDF file
            $table->string('file_name'); // Original filename
            $table->integer('file_size')->nullable(); // File size in bytes
            $table->integer('urutan')->default(0); // Order for display
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peraturan');
    }
};
