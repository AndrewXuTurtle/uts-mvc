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
        Schema::table('dosen', function (Blueprint $table) {
            $table->string('google_scholar_link')->nullable()->after('foto');
            $table->string('sinta_link')->nullable()->after('google_scholar_link');
            $table->string('scopus_link')->nullable()->after('sinta_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropColumn(['google_scholar_link', 'sinta_link', 'scopus_link']);
        });
    }
};
