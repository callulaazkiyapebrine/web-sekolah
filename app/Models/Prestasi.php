<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasis';

    protected $fillable = [
        'judul',
        'kategori',
        'tingkat',
        'penyelenggara',
        'tanggal_raih',
        'deskripsi',
        'foto',
    ];
}
