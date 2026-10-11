<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\ProfileSekolah;
use App\Models\Siswa;

class LandingController extends Controller
{
    public function index()
    {
        $profil = ProfileSekolah::first();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalEsktrakurikuler = Ekstrakurikuler::count();
        $guru = Guru::all();
        $berita = Berita::latest()->get();
        $ekstrakurikuler = Ekstrakurikuler::all();
        $galeri = Galeri::all();

        return view('landing.index', compact(
            'profil',
            'totalSiswa',
            'totalGuru',
            'totalEsktrakurikuler',
            'guru',
            'berita',
            'ekstrakurikuler',
            'galeri'
        ));
    }

    public function profil()
    {
        $profil = ProfileSekolah::first();

        return view('public.profil', compact('profil'));
    }

    public function guru()
    {
        $profil = ProfileSekolah::first();
        $guru = Guru::all();

        return view('public.guru', compact('profil', 'guru'));
    }

    public function showGuru($id)
    {
        $guru = Guru::findOrFail($id);
        $profil = ProfileSekolah::first();

        return view('public.guru-detail', compact('guru', 'profil'));
    }

    public function berita()
    {
        $profil = ProfileSekolah::first();
        $berita = Berita::latest()->get();

        return view('public.berita', compact('profil', 'berita'));
    }

    public function showBerita($slug)
    {
        $profil = ProfileSekolah::first();
        $berita = Berita::where('slug', $slug)->firstOrFail();

        return view('public.berita-detail', compact('profil', 'berita'));
    }

    public function ekstrakurikuler()
    {
        $profil = ProfileSekolah::first();
        $ekstrakurikuler = Ekstrakurikuler::all();

        return view('public.ekstrakurikuler', compact('profil', 'ekstrakurikuler'));
    }

    public function showEkstrakurikuler($slug)
    {
        $profil = ProfileSekolah::first();

        // Pastikan variabelnya bernama $ekskul
        $ekstrakurikuler = Ekstrakurikuler::where('slug', $slug)->firstOrFail();

        // Pastikan menggunakan compact('profil', 'ekskul')
        return view('public.ekstrakurikuler-detail', compact('profil', 'ekstrakurikuler'));
    }

    public function galeri()
    {
        $profil = ProfileSekolah::first();
        $galeri = Galeri::all();

        return view('public.galeri', compact('profil', 'galeri'));
    }

    public function showGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        $profil = ProfileSekolah::first();

        return view('public.galeri-detail', compact('galeri', 'profil'));
    }
}
