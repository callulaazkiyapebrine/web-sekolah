<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'ekstrakurikuler';

    // Tentukan primary key kustom
    protected $primaryKey = 'id_ekskul';

    // Field yang boleh diisi
    protected $fillable = [
        'nama_ekskul',
        'slug',
        'id_guru',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
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
