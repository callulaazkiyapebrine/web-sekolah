<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ganti 'ekstrakurikulers' menjadi 'ekstrakurikuler'
        if (Schema::hasTable('ekstrakurikuler') && !Schema::hasColumn('ekstrakurikuler', 'slug')) {
            Schema::table('ekstrakurikuler', function (Blueprint $table) {
                // Gunakan after('nama_ekskul') atau after('nama') sesuai nama kolom judul di tabel Anda
                $table->string('slug')->nullable()->unique()->after('nama_ekskul');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('ekstrakurikuler') && Schema::hasColumn('ekstrakurikuler', 'slug')) {
            Schema::table('ekstrakurikuler', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};
