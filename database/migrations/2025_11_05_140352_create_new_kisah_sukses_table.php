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
        Schema::create('kisah_sukses', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20);
            $table->foreign('nim')->references('nim')->on('alumni')->onDelete('cascade');
            
            $table->string('judul');
            $table->text('kisah');
            $table->string('pencapaian')->nullable();
            $table->year('tahun_pencapaian')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Draft', 'Published'])->default('Published');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kisah_sukses');
    }
};
