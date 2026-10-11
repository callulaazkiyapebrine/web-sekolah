<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSekolah extends Model
{
    use HasFactory;

    protected $table = 'profil_sekolahs';

    // Ubah ke 'id' (karena nama kolom ID di tabel database kamu adalah 'id', bukan 'id_profil')
    protected $primaryKey = 'id';

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
