@extends('admin_app') {{-- Sesuaikan nama layout admin kamu --}}

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-800">Edit Profil Sekolah</h1>
        <a href="{{ route('admin.profile-sekolah.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Edit Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.profile-sekolah.save') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Identitas Sekolah -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kepala Sekolah</label>
                    <input type="text" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $profil->nama_kepala_sekolah ?? '') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">NPSN</label>
                    <input type="text" name="npsn" value="{{ old('npsn', $profil->npsn ?? '') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Berdiri</label>
                    <input type="number" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No. Telepon / Kontak</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon ?? '') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $profil->alamat ?? '') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Deskripsi & Visi Misi (Disatukan/Sesuai Permintaan) -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Sekolah</label>
                    <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan gambaran umum sekolah...">{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Visi & Misi Sekolah</label>
                    <textarea name="visi_misi" rows="5" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan visi dan misi sekolah...">{{ old('visi_misi', $profil->visi_misi ?? '') }}</textarea>
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Upload Logo, Foto Gedung & Foto Kepala Sekolah -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Logo Sekolah</label>
                    @if(isset($profil->logo) && file_exists(public_path('storage/' . $profil->logo)))
                        <div class="mb-2"><img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo" class="w-16 h-16 object-contain border rounded"></div>
                    @endif
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max: 2MB).</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Gedung Sekolah</label>
                    @if(isset($profil->foto_gedung) && file_exists(public_path('storage/' . $profil->foto_gedung)))
                        <div class="mb-2"><img src="{{ asset('storage/' . $profil->foto_gedung) }}" alt="Gedung" class="w-16 h-16 object-cover border rounded"></div>
                    @endif
                    <input type="file" name="foto_gedung" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max: 2MB).</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Kepala Sekolah</label>
                    @if(isset($profil->foto_kepala_sekolah) && file_exists(public_path('storage/' . $profil->foto_kepala_sekolah)))
                        <div class="mb-2"><img src="{{ asset('storage/' . $profil->foto_kepala_sekolah) }}" alt="Kasek" class="w-16 h-16 object-cover border rounded"></div>
                    @endif
                    <input type="file" name="foto_kepala_sekolah" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max: 2MB).</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('admin.profile-sekolah.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
