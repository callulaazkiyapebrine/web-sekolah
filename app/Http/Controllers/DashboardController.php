<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfileSekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama admin dengan statistik data nyata dari database.
     */
    public function index()
    {
        // 1. Menghitung total data dari masing-masing model
        $totalGuru            = Guru::count();
        $totalSiswa           = Siswa::count();
        $totalBerita          = Berita::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $totalGaleri          = Galeri::count();

        // 2. Mengambil data profil sekolah
        $profilSekolah = ProfileSekolah::first();

        // 3. Mengambil berita terbaru untuk widget ringkasan
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return view('public.dashboard', [
            'title'                => 'Dashboard',
            'totalGuru'            => $totalGuru,
            'totalSiswa'           => $totalSiswa,
            'totalBerita'          => $totalBerita,
            'totalEkstrakurikuler' => $totalEkstrakurikuler,
            'totalGaleri'          => $totalGaleri,
            'profilSekolah'        => $profilSekolah,
            'beritaTerbaru'        => $beritaTerbaru,
        ]);
    }

    public function publicDashboard()
    {
        // 1. Menghitung total data dari masing-masing model
        $totalGuru            = Guru::count();
        $totalSiswa           = Siswa::count();
        $totalBerita          = Berita::count();
        $totalEkstrakurikuler = Ekstrakurikuler::count();
        $totalGaleri          = Galeri::count();

        // 2. Mengambil data profil sekolah
        $profilSekolah = ProfileSekolah::first();

        // 3. Mengambil berita terbaru
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return view('public.dashboard', [
            'title'                => 'Beranda Website Sekolah',
            'totalGuru'            => $totalGuru,
            'totalSiswa'           => $totalSiswa,
            'totalBerita'          => $totalBerita,
            'totalEkstrakurikuler' => $totalEkstrakurikuler,
            'totalGaleri'          => $totalGaleri,
            'profilSekolah'        => $profilSekolah,
            'beritaTerbaru'        => $beritaTerbaru,
        ]);
    }
}
