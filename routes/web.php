<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Landing / Beranda
// Route Beranda
Route::get('/', [LandingController::class, 'index'])->name('beranda');

Route::get('/profil', [LandingController::class, 'profil'])->name('public.profil');

Route::get('/guru', [LandingController::class, 'guru'])->name('public.guru');
Route::get('/guru/{id}', [LandingController::class, 'showGuru'])->name('guru.show');

//siswa
Route::get('/siswa', [LandingController::class, 'siswa'])->name('public.siswa');
Route::get('/siswa/{id}', [LandingController::class, 'showSiswa'])->name('siswa.show');

// Route Berita
Route::get('/berita', [LandingController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [LandingController::class, 'showBerita'])->name('berita.show');

// Route Ekstrakurikuler (Daftar & Detail)
Route::get('/ekstrakurikuler', [LandingController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
Route::get('/ekstrakurikuler/{slug}', [LandingController::class, 'showEkstrakurikuler'])->name('ekstrakurikuler.show');

Route::get('/galeri', [LandingController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [LandingController::class, 'showGaleri'])->name('galeri.show');

Route::get('/dataProfile', [LandingController::class, 'dataProfile'])->name('public.data-profile');

// 2. AUTENTIKASI
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.proses');
});

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// 3. PANEL ADMIN (BISA DIAKSES LANGSUNG TANPA LOGIN)
Route::prefix('admin')->group(function () {

    // DASHBOARD ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // PROFIL SEKOLAH
    Route::get('/profil-sekolah', [ProfileSekolahController::class, 'index'])->name('admin.profile-sekolah.index');
    Route::get('/profil-sekolah/edit', [ProfileSekolahController::class, 'edit'])->name('admin.profile-sekolah.edit');
    Route::post('/profil-sekolah/save', [ProfileSekolahController::class, 'save'])->name('admin.profile-sekolah.save');

    // EKSTRAKURIKULER
    Route::prefix('ekstrakurikuler')->group(function () {
        Route::get('/', [EkstrakurikulerController::class, 'index'])->name('admin.ekstrakurikuler.index');
        Route::get('/add-edit/{id?}', [EkstrakurikulerController::class, 'addEdit'])->name('admin.ekstrakurikuler.addEdit');
        Route::post('/save/{id?}', [EkstrakurikulerController::class, 'save'])->name('admin.ekstrakurikuler.save');
        Route::get('/{id}', [EkstrakurikulerController::class, 'show'])->name('admin.ekstrakurikuler.show');
        Route::delete('/{id}', [EkstrakurikulerController::class, 'destroy'])->name('admin.ekstrakurikuler.destroy');
    });

    // SISWA
    Route::prefix('siswa')->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('admin.siswa.index');
        Route::get('/addEdit/{id?}', [SiswaController::class, 'addEdit'])->name('admin.siswa.addEdit');
        // Pastikan metodenya POST
        Route::post('/admin/siswa/simpan/{id?}', [SiswaController::class, 'save'])->name('admin.siswa.save');
        Route::match(['get', 'post'], '/admin/siswa/simpan/{id?}', [SiswaController::class, 'save'])->name('admin.siswa.save');
        Route::get('/{id}', [SiswaController::class, 'show'])->name('admin.siswa.show');
        Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.delete');
    });

    // GURU
    Route::prefix('guru')->group(function () {
        Route::get('/', [GuruController::class, 'index'])->name('admin.guru.index');
        Route::get('/add-edit/{id?}', [GuruController::class, 'addEdit'])->name('admin.guru.addEdit');
        Route::post('/save/{id?}', [GuruController::class, 'save'])->name('admin.guru.save');

        // 1. Rute /show/{id} HARUS ditaruh di ATAS rute wildcard /{id}
        Route::get('/show/{id}', [GuruController::class, 'show'])->name('admin.guru.show');

        // 2. Rute wildcard /{id} (DELETE) ditaruh di PALING BAWAH
        Route::delete('/{id}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');
    });
    // GALERI
    Route::prefix('galeri')->group(function () {
        Route::get('/', [GaleriController::class, 'index'])->name('admin.galeri.index');
        Route::get('/add-edit/{id?}', [GaleriController::class, 'addEdit'])->name('admin.galeri.addEdit');
        Route::post('/save/{id?}', [GaleriController::class, 'save'])->name('admin.galeri.save');
        Route::get('/{id}', [GaleriController::class, 'show'])->name('admin.galeri.show');
        Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.delete');
    });

    // BERITA
    // BERITA
    Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('admin.berita.index');
        Route::get('/add-edit/{id?}', [BeritaController::class, 'addEdit'])->name('admin.berita.addEdit');
        Route::post('/save/{id?}', [BeritaController::class, 'save'])->name('admin.berita.save');
        Route::get('/show/{id}', [BeritaController::class, 'show'])->name('admin.berita.show');
        Route::delete('/delete/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.delete');
    });

    // MANAGEMENT USER
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add-edit/{id?}', [UserController::class, 'addEdit'])->name('admin.user.addEdit');
        Route::post('/save/{id?}', [UserController::class, 'save'])->name('admin.user.save');
        Route::get('/{id}', [UserController::class, 'show'])->name('admin.user.show');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
    });

});
