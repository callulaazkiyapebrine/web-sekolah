@extends('admin_app')

@section('title', $title ?? 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
    <!-- BANNER UTAMA (BIRU TUT WURI HANDAYANI WITH ACCENT GOLD) -->
    <div
        class="relative flex flex-col md:flex-row items-center justify-between min-w-0 break-words bg-sky-600 shadow-soft-xl rounded-2xl mb-6 p-6 text-white border-l-8 border-amber-400">
        <div>
            <h4 class="text-white font-bold mb-1 text-2xl flex items-center gap-2">
                Halo, {{ auth()->user()->name ?? 'Administrator' }}! 👋
            </h4>
            <p class="text-sky-100 text-sm mb-0">
                Selamat datang kembali di Panel Administrator Sistem Informasi Akademik.
            </p>
        </div>
        <div
            class="mt-4 md:mt-0 flex items-center bg-sky-700/60 text-amber-300 px-4 py-2 rounded-xl text-xs font-semibold tracking-wide border border-amber-400/40 shadow-sm">
            <i class="far fa-calendar-alt mr-2 text-amber-400"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- GRID KARTU SEKOLAH & STATISTIK -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        <!-- KARTU ID SEKOLAH (DENGAN LOGO DINAMIS) -->
        <div class="lg:col-span-1">
            <div
                class="relative flex flex-col items-center justify-center p-6 bg-gradient-to-b from-sky-800 to-sky-950 text-white rounded-2xl shadow-soft-xl h-full min-h-[230px] border border-sky-700">

                <!-- BADGE NPSN -->
                <div
                    class="absolute top-4 left-4 bg-sky-900/90 text-amber-300 text-xs px-3 py-1 rounded-full border border-amber-400/30 font-medium">
                    NPSN: {{ data_get($profil, 'npsn', '-') }}
                </div>

                <div class="text-center mt-6">
                    <!-- LOGO SEKOLAH -->
                    @php
                        $logoPath = data_get($profil, 'logo');
                    @endphp
                    @if ($logoPath && file_exists(public_path('storage/' . $logoPath)))
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo Sekolah"
                            class="w-20 h-20 object-contain mx-auto mb-3 drop-shadow-md">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Tut_Wuri_Handayani.png/240px-Logo_Tut_Wuri_Handayani.png"
                            alt="Logo Tut Wuri Handayani"
                            class="w-20 h-20 object-contain mx-auto mb-3 drop-shadow-md">
                    @endif

                    <h5 class="text-white font-bold text-lg mb-0 tracking-wide">
                        {{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}
                    </h5>
                    <p class="text-sky-200/80 text-xs mt-1 font-medium">Panel Administrator Sistem</p>
                </div>
            </div>
        </div>

        <!-- GRID 4 KARTU STATISTIK -->
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- TOTAL SISWA -->
            <div
                class="bg-white p-5 rounded-2xl shadow-soft-xl border border-sky-100 flex justify-between items-center hover:shadow-md transition-all">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">TOTAL SISWA</p>
                    <h3 class="text-2xl font-bold text-sky-900 mb-1">
                        {{ $totalSiswa ?? 0 }}
                    </h3>
                    <span class="text-xs text-sky-600 font-medium">Siswa Terdaftar</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl border border-sky-100">
                    <i class="fas fa-users"></i>
                </div>
            </div>

            <!-- TOTAL GURU -->
            <div
                class="bg-white p-5 rounded-2xl shadow-soft-xl border border-sky-100 flex justify-between items-center hover:shadow-md transition-all">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">TOTAL GURU</p>
                    <h3 class="text-2xl font-bold text-sky-900 mb-1">
                        {{ $totalGuru ?? 0 }}
                    </h3>
                    <span class="text-xs text-sky-600 font-medium">Tenaga Pendidik</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-xl border border-sky-200">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>

            <!-- EKSTRAKURIKULER -->
            <div
                class="bg-white p-5 rounded-2xl shadow-soft-xl border border-amber-100 flex justify-between items-center hover:shadow-md transition-all">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">EKSTRAKURIKULER</p>
                    <h3 class="text-2xl font-bold text-amber-900 mb-1">
                        {{ $totalEkstrakurikuler ?? 0 }}
                    </h3>
                    <span class="text-xs text-amber-600 font-medium">Kegiatan Aktif</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl border border-amber-200">
                    <i class="fas fa-basketball-ball"></i>
                </div>
            </div>

            <!-- TOTAL BERITA -->
            <div
                class="bg-white p-5 rounded-2xl shadow-soft-xl border border-amber-100 flex justify-between items-center border-l-4 border-l-amber-400 hover:shadow-md transition-all">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">TOTAL BERITA</p>
                    <h3 class="text-2xl font-bold text-amber-900 mb-1">
                        {{ $totalBerita ?? 0 }}
                    </h3>
                    <span class="text-xs text-amber-600 font-medium">Artikel Publikasi</span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>

        </div>
    </div>

    <!-- TABEL BERITA TERBARU -->
    <div class="bg-white rounded-2xl shadow-soft-xl p-6 border border-sky-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-2">
            <div>
                <h6 class="font-bold text-sky-950 text-lg mb-0 flex items-center gap-2">
                    <i class="fas fa-newspaper text-sky-600"></i> Berita & Informasi Terbaru
                </h6>
                <p class="text-xs text-slate-400 mb-0">Daftar artikel atau pengumuman yang baru dipublikasikan</p>
            </div>
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-sky-50 text-sky-700 border border-sky-200">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                Live Data
            </span>
        </div>

        <div class="overflow-x-auto">
            <table id="table-berita-dashboard" class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-sky-900 uppercase bg-sky-50/70 border-b border-sky-100">
                    <tr>
                        <th class="py-3 px-4">Judul Berita</th>
                        <th class="py-3 px-4">Tanggal Publikasi</th>
                        <th class="py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritaTerbaru ?? [] as $item)
                        <tr class="border-b hover:bg-sky-50/30">
                            <td class="py-3.5 px-4 font-semibold text-slate-700">
                                {{ $item->judul ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-slate-500">
                                <i class="far fa-calendar text-sky-500 mr-1"></i>
                                {{ isset($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-sky-100 text-sky-800 border border-sky-200">
                                    Dipublikasikan
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-xs text-slate-400">
                                Belum ada berita yang dipublikasikan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
