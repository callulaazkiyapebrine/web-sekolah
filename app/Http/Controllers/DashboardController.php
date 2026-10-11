<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Guru;
use App\Models\ProfileSekolah;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    // Halaman Landing Page Publik
    public function publicDashboard()
    {
        // Ambil data profil sekolah
        $profil = Schema::hasTable('profil_sekolahs')
            ? DB::table('profil_sekolahs')->first()
            : null;

        // Ambil data pendukung
        $berita = Schema::hasTable('beritas')
            ? DB::table('beritas')->latest()->take(3)->get()
            : collect();

        $ekstrakurikuler = Schema::hasTable('ekstrakurikulers')
            ? DB::table('ekstrakurikulers')->take(6)->get()
            : collect();

        $guru = Schema::hasTable('gurus')
            ? DB::table('gurus')->take(8)->get()
            : collect();

        $galeri = Schema::hasTable('galeris')
            ? DB::table('galeris')->latest()->take(6)->get()
            : collect();

        // Hitung statistik
        $totalSiswa = Schema::hasTable('siswas') ? DB::table('siswas')->count() : 0;
        $totalGuru = Schema::hasTable('gurus') ? DB::table('gurus')->count() : 0;
        $totalEkskul = Schema::hasTable('ekstrakurikulers') ? DB::table('ekstrakurikulers')->count() : 0;

        return view('landing.index', compact(
            'profil',
            'berita',
            'ekstrakurikuler',
            'guru',
            'galeri',
            'totalSiswa',
            'totalGuru',
            'totalEkskul'
        ));
    }

    public function index()
    {
        $profil = ProfileSekolah::first(); // Tambahkan baris ini
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $totalBerita = Berita::count();
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'profil',
            'totalSiswa',
            'totalGuru',
            'totalEkstrakurikuler',
            'totalBerita',
            'beritaTerbaru'
        ));
    }
}
