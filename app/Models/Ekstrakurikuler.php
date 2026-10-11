<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- Tambahkan baris ini di sini

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'id_ekstrakurikuler'; // Sesuaikan jika primary key anda id_ekstrakurikuler

    protected $fillable = [
        'nama_ekskul',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'foto',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($ekskul) {
            if (empty($ekskul->slug) || $ekskul->isDirty('nama_ekskul')) {
                $ekskul->slug = Str::slug($ekskul->nama_ekskul ?? $ekskul->nama);
            }
        });
    }

    // Relasi ke Model Guru (Foreign Key id_guru)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}