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
        Schema::table('tbl_mahasiswa', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('angkatan');
            $table->unique('nim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_mahasiswa', function (Blueprint $table) {
            $table->dropUnique(['nim']);
            $table->dropColumn('foto');
        });
    }
};
