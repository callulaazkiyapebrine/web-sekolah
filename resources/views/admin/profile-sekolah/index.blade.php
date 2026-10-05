@extends('admin_app')

@section('title', $title ?? 'Profile Sekolah')
@section('breadcrumb', 'Profile Sekolah')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- KARTU 1: IDENTITAS SEKOLAH (PREVIEW) -->
        <div class="lg:col-span-1">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border h-full">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="mb-0 font-bold text-sky-950 flex items-center gap-2">
                        <i class="fas fa-info-circle text-sky-600"></i> Identitas Sekolah
                    </h6>
                </div>
                <div class="flex-auto p-6 text-center">
                    <!-- LOGO SEKOLAH -->
                    <div class="mb-4">
                        @if (isset($profil->logo) && file_exists(public_path('storage/' . $profil->logo)))
                            <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah"
                                class="w-28 h-28 object-contain mx-auto drop-shadow-md">
                        @else
                            <img src="https://raw.githubusercontent.com/PKM-KC-2021/Assets/main/Tutwuri.png"
                                alt="Logo Tut Wuri Handayani" class="w-28 h-28 object-contain mx-auto drop-shadow-md"
                                onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Tut_Wuri_Handayani.png/240px-Logo_Tut_Wuri_Handayani.png';">
                        @endif
                    </div>

                    <h5 class="font-bold text-slate-800 text-lg mb-1">
                        {{ $profil->nama_sekolah ?? 'SMK YPC TASIKMALAYA' }}
                    </h5>
                    <p class="text-xs text-slate-400 mb-6">
                        <i class="fas fa-user-tie text-sky-500 mr-1"></i>
                        {{ $profil->nama_kepala_sekolah ?? '-' }}
                    </p>

                    <!-- DETAIL RINCIAN -->
                    <div class="border-t border-gray-100 pt-4 text-left space-y-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium flex items-center gap-2">
                                <i class="fas fa-th-large text-xs text-sky-600"></i> NPSN:
                            </span>
                            <span class="font-semibold text-slate-700">{{ $profil->npsn ?? '-' }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-xs text-sky-600"></i> Tahun Berdiri:
                            </span>
                            <span class="font-semibold text-slate-700">{{ $profil->tahun_berdiri ?? '-' }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-slate-400 font-medium flex items-center gap-2">
                                <i class="fas fa-phone text-xs text-sky-600"></i> Kontak:
                            </span>
                            <span class="font-semibold text-slate-700">{{ $profil->no_telepon ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KARTU 2: FORM EDIT / UPDATE PROFILE SEKOLAH -->
        <div class="lg:col-span-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="mb-0 font-bold text-sky-950 flex items-center gap-2">
                        <i class="fas fa-edit text-sky-600"></i> Edit Profile Sekolah
                    </h6>
                    <p class="text-xs text-slate-400 mb-0">Ubah dan perbarui data profil sekolah di bawah ini</p>
                </div>

                <div class="flex-auto p-6">

                    <!-- NOTIFIKASI SUKSES -->
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-emerald-100 border border-emerald-400 text-emerald-800 rounded-xl text-xs flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-600 text-base"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- NOTIFIKASI ERROR VALIDASI -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded-xl text-xs">
                            <p class="font-bold mb-1">Terjadi kesalahan input:</p>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile-sekolah.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- NAMA SEKOLAH -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Nama Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_sekolah"
                                    value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}"
                                    class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                    required>
                            </div>

                            <!-- NAMA KEPALA SEKOLAH -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Nama Kepala Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_kepala_sekolah"
                                    value="{{ old('nama_kepala_sekolah', $profil->nama_kepala_sekolah ?? '') }}"
                                    class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                    required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- NPSN -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    NPSN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="npsn"
                                    value="{{ old('npsn', $profil->npsn ?? '') }}"
                                    class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                    required>
                            </div>

                            <!-- TAHUN BERDIRI -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Tahun Berdiri <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="tahun_berdiri"
                                    value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}"
                                    class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                    required>
                            </div>

                            <!-- NO KONTAK / TELEPON -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    No. Kontak / Telepon <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="no_telepon"
                                    value="{{ old('no_telepon', $profil->no_telepon ?? '') }}"
                                    class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                    required>
                            </div>
                        </div>

                        <!-- ALAMAT LENGKAP -->
                        <div class="mb-4">
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" rows="2"
                                class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                required>{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                        </div>

                        <!-- VISI & MISI -->
                        <div class="mb-4">
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                Visi & Misi Sekolah <span class="text-red-500">*</span>
                            </label>
                            <textarea name="visi_misi" rows="3"
                                class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500"
                                required>{{ old('visi_misi', $profil->visi_misi ?? '') }}</textarea>
                        </div>

                        <!-- DESKRIPSI / SAMBUTAN -->
                        <div class="mb-4">
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                Deskripsi / Sambutan Sekolah
                            </label>
                            <textarea name="deskripsi" rows="3"
                                class="w-full text-sm rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                        </div>

                        <!-- UPLOAD FILE LOGO & FOTO GEDUNG -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Ganti Logo Sekolah
                                </label>
                                <input type="file" name="logo"
                                    class="w-full text-xs rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika tidak diubah. Format JPG/PNG (Maks: 2MB).</p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Ganti Foto Gedung Sekolah
                                </label>
                                <input type="file" name="foto_gedung"
                                    class="w-full text-xs rounded-xl border border-solid border-gray-300 bg-white px-3 py-2 text-gray-700 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika tidak diubah. Format JPG/PNG (Maks: 2MB).</p>
                            </div>
                        </div>

                        <!-- TOMBOL SUBMIT -->
                        <div class="text-right">
                            <button type="submit"
                                class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-md transition-all cursor-pointer">
                                <i class="fas fa-save text-xs"></i> SIMPAN PERUBAHAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
