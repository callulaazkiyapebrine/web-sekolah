<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSekolah extends Model
{
    use HasFactory;

    protected $table = 'profil_sekolahs';

    // TAMBAHKAN BARIS INI (Ganti 'id_profil' dengan nama kolom ID sebenarnya di tabel Anda)
    protected $primaryKey = 'id_profil'; // Contoh jika nama kolomnya id_profil / id_sekolah

    protected $fillable = [
        'nama_sekolah',
        'nama_kepala_sekolah',
        'npsn',
        'tahun_berdiri',
        'no_telepon',
        'alamat',
        'visi_misi',
        'deskripsi',
        'logo',
        'foto_gedung',
    ];
}
