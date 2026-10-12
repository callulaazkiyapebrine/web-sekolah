<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col justify-between">

    <!-- TOPBAR BIRU PENDIDIKAN -->
    <div class="bg-sky-700 text-white text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
        </div>
    </div>

    <!-- NAVBAR UTAMA -->
    <header x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Navigation Menu (Desktop) -->
                <nav class="hidden md:flex items-center space-x-6 text-xs font-semibold text-gray-700">
                    <a href="{{ route('beranda') }}" class="hover:text-sky-600 transition">Beranda</a>
                    <a href="{{ url('/profil') }}" class="text-sky-600 font-bold transition">Profil</a>
                    <a href="{{ route('public.guru') }}" class="hover:text-sky-600 transition">Guru</a>
                    <a href="{{ route('berita') }}" class="hover:text-sky-600 transition">Berita</a>
                    <a href="{{ route('ekstrakurikuler') }}" class="hover:text-sky-600 transition">Ekstrakurikuler</a>
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
                class="block py-1 text-sky-600 font-bold">Profil</a>
            <a href="{{ route('public.guru') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Guru</a>
            <a href="{{ route('berita') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Berita</a>
            <a href="{{ route('ekstrakurikuler') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Ekstrakurikuler</a>
            <a href="{{ route('galeri') }}" @click="open = false"
                class="block py-1 text-gray-700 hover:text-sky-600">Galeri</a>
        </div>
    </header>

           <!-- IDENTITAS SINGKAT SEKOLAH -->
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <h3 class="font-bold text-gray-900 text-base mb-4 border-b pb-2">Data Profile</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                    <div>
                        <span class="text-gray-500 block">Nama:</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block">NISN:</span>
                    <div>
                        <span class="text-gray-500 block">Telepon:</span>
                    </div>
                    <div>
                        <span class="text-gray-500 block">Alamat:</span>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- FOOTER UTAMA -->
    <footer class="bg-sky-600 text-white text-xs py-12 border-t border-sky-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Grid 3 Kolom -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-8 pb-8 border-b border-sky-500/50">

                <!-- Kolom 1: Profil / Deskripsi Sekolah -->
                <div class="md:col-span-6 space-y-3">
                </div>

                <!-- Kolom 2: Menu Navigasi -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="font-bold text-sm tracking-wider uppercase">Menu</h3>
                    <ul class="space-y-2 text-sky-100 text-[11px]">
                        <li><a href="{{ route('beranda') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ url('/profil') }}" class="hover:text-white transition">Profile Sekolah</a></li>
                        <li><a href="{{ route('public.guru') }}" class="hover:text-white transition">Staf & Guru</a></li>
                        <li><a href="{{ route('berita') }}" class="hover:text-white transition">Berita</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri</a></li>
                        <li><a href="{{ route('ekstrakurikuler') }}" class="hover:text-white transition">Ekstrakurikuler</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="font-bold text-sm tracking-wider uppercase">Kontak</h3>
                    <div class="space-y-2 text-sky-100 text-[11px] leading-relaxed">
                        <p class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-0.5 flex-shrink-0"></i>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-phone-alt flex-shrink-0"></i>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Copyright Bawah -->
            <div class="text-center text-sky-100 text-[11px]">
            </div>

        </div>
    </footer>
</body>

</html>
