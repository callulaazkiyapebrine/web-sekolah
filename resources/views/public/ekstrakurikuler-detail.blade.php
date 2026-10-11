<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ekstrakurikuler->nama_ekstrakurikuler ?? $ekstrakurikuler->nama }} | {{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col justify-between">

    <!-- TOPBAR BIRU PENDIDIKAN -->
    <div class="bg-sky-700 text-white text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <span><i class="fas fa-school mr-1.5"></i> Website Resmi
                {{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}</span>
            <span>NPSN: {{ data_get($profil, 'npsn', '-') }}</span>
        </div>
    </div>

    <!-- NAVBAR UTAMA -->
    <header x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    @php
                        $logoPath = data_get($profil, 'logo');
                    @endphp
                    @if ($logoPath && file_exists(public_path('storage/' . $logoPath)))
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" class="w-10 h-10 object-contain">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Tut_Wuri_Handayani.png/240px-Logo_Tut_Wuri_Handayani.png"
                            alt="Logo" class="w-10 h-10 object-contain">
                    @endif
                    <div>
                        <span class="font-bold text-base md:text-lg text-gray-900 tracking-tight block leading-tight">
                            {{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}
                        </span>
                        <span class="text-[10px] text-sky-700 font-semibold tracking-wider uppercase">Dinas
                            Pendidikan</span>
                    </div>
                </div>

                <!-- Navigation Menu (Desktop) -->
                <nav class="hidden md:flex items-center space-x-6 text-xs font-semibold text-gray-700">
                    <a href="{{ route('beranda') }}" class="hover:text-sky-600 transition">Beranda</a>
                    <a href="{{ url('/profil') }}" class="hover:text-sky-600 transition">Profil</a>
                    <a href="{{ route('public.guru') }}" class="hover:text-sky-600 transition">Guru</a>
                    <a href="{{ route('berita') }}" class="hover:text-sky-600 transition">Berita</a>
                    <a href="{{ route('ekstrakurikuler') }}"
                        class="text-sky-600 font-bold transition">Ekstrakurikuler</a>
                    <a href="{{ route('galeri') }}" class="hover:text-sky-600 transition">Galeri</a>
                </nav>

                <!-- Tombol Admin / Login -->
                <div>
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold px-4 py-2 rounded shadow-sm transition">
                            <i class="fas fa-gauge mr-1"></i> Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold px-4 py-2 rounded shadow-sm transition">
                            <i class="fas fa-sign-in-alt mr-1"></i> Masuk Admin
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 p-2">
                        <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-cloak class="md:hidden bg-white border-t px-4 py-3 space-y-2 text-sm font-medium">
            <a href="{{ route('beranda') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Beranda</a>
            <a href="{{ url('/profil') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Profil</a>
            <a href="{{ route('public.guru') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Guru</a>
            <a href="{{ route('berita') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Berita</a>
            <a href="{{ route('ekstrakurikuler') }}" @click="open = false"
                class="block py-1 text-sky-600 font-bold">Ekstrakurikuler</a>
            <a href="{{ route('galeri') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Galeri</a>
        </div>
    </header>

    <!-- MAIN CONTENT DETAIL EKSTRAKURIKULER -->
    <main class="py-10 max-w-6xl mx-auto px-4 w-full flex-1">

        <!-- Breadcrumb Navigation -->
        <nav class="flex text-xs text-gray-500 mb-6 gap-2">
            <a href="{{ route('beranda') }}" class="hover:text-sky-600">Beranda</a>
            <span>&raquo;</span>
            <a href="{{ route('ekstrakurikuler') }}" class="hover:text-sky-600">Ekstrakurikuler</a>
            <span>&raquo;</span>
            <span class="text-gray-800 font-medium">{{ $ekstrakurikuler->nama_ekstrakurikuler ?? $ekstrakurikuler->nama }}</span>
        </nav>

        <!-- Tombol Kembali -->
        <a href="{{ route('ekstrakurikuler') }}"
            class="inline-flex items-center gap-2 text-xs font-semibold text-sky-600 hover:text-sky-700 mb-6 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm transition">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ekstrakurikuler
        </a>

        <!-- Grid Layout Foto & List Card Data Memanjang -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

            <!-- Foto Kiri -->
            <div class="md:col-span-5 lg:col-span-4">
                <div class="rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-white p-4 text-center">
                    @if ($ekstrakurikuler->foto && file_exists(public_path('storage/' . $ekstrakurikuler->foto)))
                        <img src="{{ asset('storage/' . $ekstrakurikuler->foto) }}" alt="{{ $ekstrakurikuler->nama_ekstrakurikuler }}"
                            class="w-full h-auto object-cover rounded-xl border border-slate-100">
                    @elseif ($ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)))
                        <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_ekstrakurikuler }}"
                            class="w-full h-auto object-cover rounded-xl border border-slate-100">
                    @else
                        <div
                            class="w-full aspect-[4/3] bg-sky-600 text-white flex flex-col items-center justify-center p-6 rounded-xl">
                            <i class="fa-solid fa-star text-6xl mb-3"></i>
                            <span class="text-xs font-medium text-sky-100">Foto belum tersedia</span>
                        </div>
                    @endif
                    <h2 class="font-bold text-slate-900 text-lg mt-3 mb-0.5 capitalize">
                        {{ $ekstrakurikuler->nama_ekstrakurikuler ?? $ekstrakurikuler->nama }}</h2>
                    <p class="text-xs font-semibold text-sky-600 uppercase tracking-wider mb-2">
                        Ekstrakurikuler Sekolah
                    </p>
                </div>
            </div>

            <!-- List Card Data Memanjang (Kanan) -->
            <div class="md:col-span-7 lg:col-span-8 space-y-3">

                <!-- Nama Kegiatan -->
                <div
                    class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex justify-between items-center text-sm">
                    <span class="text-slate-500 font-medium">Nama Ekstrakurikuler</span>
                    <span
                        class="font-bold text-slate-900 capitalize">{{ $ekstrakurikuler->nama_ekstrakurikuler ?? $ekstrakurikuler->nama }}</span>
                </div>

                <!-- Pembina -->
                <div
                    class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex justify-between items-center text-sm">
                    <span class="text-slate-500 font-medium">Pembina / Pengampu</span>
                    <span
                        class="font-bold text-slate-900">{{ $ekstrakurikuler->pembina ?? ($ekstrakurikuler->nama_pembina ?? '-') }}</span>
                </div>

                <!-- Deskripsi Lengkap -->
                <div class="bg-white border border-slate-100 rounded-xl p-5 shadow-sm space-y-2">
                    <span class="text-slate-500 font-medium block text-sm">Deskripsi & Keterangan</span>
                    <p class="text-sm text-slate-700 leading-relaxed">
                        {{ $ekskul->deskripsi ?? 'Belum ada deskripsi untuk kegiatan ekstrakurikuler ini.' }}
                    </p>
                </div>

            </div>

        </div>

    </main>

    <!-- FOOTER UTAMA -->
    <footer class="bg-sky-600 text-white text-xs py-12 border-t border-sky-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Grid 3 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-8 pb-8 border-b border-sky-500/50">

                <!-- Kolom 1: Profil / Deskripsi Sekolah (Lebar 6) -->
                <div class="md:col-span-6 space-y-3">
                    <h3 class="font-bold text-sm tracking-wider uppercase">
                        {{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}
                    </h3>
                    <p class="text-sky-100 text-[11px] leading-relaxed max-w-lg">
                        {{ data_get($profil, 'deskripsi') ?? 'Website resmi sekolah yang mengunggulkan pendidikan terpadu, berakhlak mulia, cerdas, kreatif, berprestasi, dan berwawasan lingkungan untuk membentuk generasi masa depan yang unggul.' }}
                    </p>
                </div>

                <!-- Kolom 2: Menu Navigasi (Lebar 3) -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="font-bold text-sm tracking-wider uppercase">Menu</h3>
                    <ul class="space-y-2 text-sky-100 text-[11px]">
                        <li><a href="{{ route('beranda') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ url('/profil') }}" class="hover:text-white transition">Profile Sekolah</a>
                        </li>
                        <li><a href="{{ route('public.guru') }}" class="hover:text-white transition">Staf & Guru</a>
                        </li>
                        <li><a href="{{ route('berita') }}" class="hover:text-white transition">Berita</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                        <li><a href="{{ route('ekstrakurikuler') }}"
                                class="hover:text-white transition">Ekstrakurikuler</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak (Lebar 3) -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="font-bold text-sm tracking-wider uppercase">Kontak</h3>
                    <div class="space-y-2 text-sky-100 text-[11px] leading-relaxed">
                        <p class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-0.5 flex-shrink-0"></i>
                            <span>{{ data_get($profil, 'alamat', 'Alamat sekolah belum diatur.') }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-phone-alt flex-shrink-0"></i>
                            <span>{{ data_get($profil, 'no_telepon') ?? (data_get($profil, 'telepon') ?? '-') }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Copyright Bawah -->
            <div class="text-center text-sky-100 text-[11px]">
                <p>&copy; {{ date('Y') }} {{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}. Seluruh Hak
                    Cipta Dilindungi.</p>
            </div>

        </div>
    </footer>
</body>

</html>
