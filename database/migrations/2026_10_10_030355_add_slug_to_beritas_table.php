<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('berita') && !Schema::hasColumn('berita', 'slug')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique()->after('judul');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('berita') && Schema::hasColumn('berita', 'slug')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};
