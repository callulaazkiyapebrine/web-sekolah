<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah 'siswas' menjadi 'siswa'
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nama_siswa');
            $table->string('kelas')->nullable(); // <-- Cukup tambahkan baris ini
            $table->string('jenis_kelamin');
            $table->integer('tahun_masuk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Ubah 'siswas' menjadi 'siswa'
        Schema::dropIfExists('siswa');
    }
};
