<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    
    // Tambahkan baris ini agar Eloquent tahu primary key-nya adalah 'id'
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'kelas',
        'jenis_kelamin',
        'tahun_masuk',
    ];
}