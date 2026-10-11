<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'tanggal',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($berita) {
            // Hanya buat slug jika kosong atau judulnya berubah
            if (empty($berita->slug) || $berita->isDirty('judul')) {
                $slug = Str::slug($berita->judul);
                $originalSlug = $slug;
                $count = 1;

                // Cek apakah slug sudah ada di database (selain record ini sendiri)
                while (static::where('slug', $slug)
                    ->where('id_berita', '!=', $berita->id_berita ?? 0)
                    ->exists()) {
                    $slug = "{$originalSlug}-{$count}";
                    $count++;
                }

                $berita->slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Sesuaikan foreign key jika namanya berbeda, misal 'id_user'
    }
}
