<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProfile extends Model
{
    use HasFactory;

    protected $table = 'data_profile';

    // Ubah ke 'id' (karena nama kolom ID di tabel database kamu adalah 'id', bukan 'id_profil')
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'nisn',
        'tanggal_lahir',
        'no_telepon',
        'alamat',
        'foto',
    ];
}
