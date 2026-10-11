@extends('admin_app')

@section('title', isset($siswa) ? 'Edit Data Siswa' : 'Tambah Data Siswa')

@section('content')
<div style="padding: 15px 20px;">
    <!-- Container Utama Putih Bersih Card -->
    <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); max-width: 800px; margin: 0 auto;">

        {{-- HEADER --}}
        <div style="margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e9ecef;">
            <h4 style="font-weight: 700; color: #212529; margin: 0 0 4px 0; font-size: 18px;">
                {{ isset($siswa) ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}
            </h4>
            <p style="color: #6c757d; font-size: 13px; margin: 0;">
                {{ isset($siswa) ? 'Silakan perbarui data siswa di bawah ini.' : 'Silakan isi formulir untuk menambahkan data siswa baru.' }}
            </p>
        </div>

        {{-- NOTIFIKASI ERROR VALIDASI --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM UTAMA --}}
        <form action="{{ route('admin.siswa.save', isset($siswa) ? Crypt::encrypt($siswa->id_siswa ?? $siswa->id) : '') }}"
              method="POST">
            @csrf

            {{-- NISN --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    NISN <span style="color: red;">*</span>
                </label>
                <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn ?? '') }}" required placeholder="Contoh: 0071234567"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">
            </div>

            {{-- NAMA LENGKAP SISWA --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Nama Lengkap Siswa <span style="color: red;">*</span>
                </label>
                <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa ?? $siswa->nama ?? '') }}" required placeholder="Contoh: Anisa Nazwa"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">
            </div>

            {{-- KELAS --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Kelas <span style="color: red;">*</span>
                </label>
                <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas ?? '') }}" required placeholder="Contoh: 6 / Enam"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">
            </div>

            {{-- JENIS KELAMIN --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Jenis Kelamin <span style="color: red;">*</span>
                </label>
                <select name="jenis_kelamin" required style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none; background-color: #fff;">
                    <option value="" disabled {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- TAHUN MASUK --}}
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Tahun Masuk <span style="color: red;">*</span>
                </label>
                <input type="number" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? date('Y')) }}" required placeholder="Contoh: 2021"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">
            </div>

            {{-- TOMBOL AKSI --}}
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <a href="{{ route('admin.siswa.index') }}"
                   style="background-color: #6c757d; color: #ffffff; padding: 8px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; display: inline-block;">
                    Kembali
                </a>
                <button type="submit"
                        style="background-color: #0d6efd; color: #ffffff; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                    {{ isset($siswa) ? 'Update Data' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
