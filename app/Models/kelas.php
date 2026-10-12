<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
    ];

    /**
     * Relasi ke model Siswa (Satu kelas memiliki banyak siswa)
     */
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'nama_kelas');
    }
}