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
        // Cek apakah tabel galeri belum ada sebelum membuat
        if (! Schema::hasTable('galeri')) {
            Schema::create('galeri', function (Blueprint $table) {
                $table->id('id_galeri');
                $table->string('judul', 50);
                $table->string('keterangan', 255);
                $table->string('file', 100);
                $table->enum('kategori', ['Foto', 'Video']);
                $table->string('tanggal', 255);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
