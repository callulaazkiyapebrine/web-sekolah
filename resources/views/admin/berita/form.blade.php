@extends('admin_app')

@section('title', isset($berita) ? 'Edit Data Berita' : 'Tambah Data Berita')

@section('content')
<div style="padding: 15px 20px;">
    <!-- Container Utama Putih Bersih Card -->
    <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); max-width: 800px; margin: 0 auto;">

        {{-- HEADER --}}
        <div style="margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e9ecef;">
            <h4 style="font-weight: 700; color: #212529; margin: 0 0 4px 0; font-size: 18px;">
                {{ isset($berita) ? 'Form Edit Data Berita' : 'Form Tambah Data Berita Baru' }}
            </h4>
            <p style="color: #6c757d; font-size: 13px; margin: 0;">
                Silakan isi formulir berita di bawah ini dengan lengkap dan benar.
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

        {{-- FORM UTAMA DENGAN ENKRIPSI ID --}}
        <form action="{{ isset($berita) && $berita ? route('admin.berita.save', Crypt::encrypt($berita->id_berita ?? $berita->id)) : route('admin.berita.save') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- JUDUL BERITA --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Judul Berita <span style="color: red;">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required placeholder="Contoh: Kegiatan Workshop Digital Marketing di Sekolah"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">
            </div>

            {{-- TANGGAL BERITA --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Tanggal Berita
                </label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal ?? date('Y-m-d')) }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">
            </div>

            {{-- GAMBAR HEADER / COVER & LIVE PREVIEW --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Gambar Header / Cover <span style="color: #6c757d; font-weight: normal;">(Opsional, Maks 2MB)</span>
                </label>

                {{-- Area Pratinjau Gambar (Live Preview) --}}
                <div style="margin-bottom: 12px;">
                    <img id="imagePreview"
                         src="{{ isset($berita) && $berita->gambar && file_exists(public_path('storage/' . $berita->gambar)) ? asset('storage/' . $berita->gambar) : '#' }}"
                         alt="Pratinjau Gambar"
                         style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px; border: 1px solid #ced4da; {{ isset($berita) && $berita->gambar && file_exists(public_path('storage/' . $berita->gambar)) ? '' : 'display: none;' }}">
                </div>

                <input type="file" name="gambar" id="fotoInput" accept="image/*" onchange="previewImage(event)"
                       style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057;">
            </div>

            {{-- ISI BERITA LENGKAP --}}
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; color: #212529; font-size: 14px; margin-bottom: 8px;">
                    Isi Berita Lengkap <span style="color: red;">*</span>
                </label>
                <textarea name="isi" rows="6" required placeholder="Tuliskan isi berita atau pengumuman secara rinci di sini..."
                          style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; color: #495057; outline: none;">{{ old('isi', $berita->isi ?? '') }}</textarea>
            </div>

            {{-- TOMBOL AKSI --}}
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <a href="{{ route('admin.berita.index') }}"
                   style="background-color: #6c757d; color: #ffffff; padding: 8px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; display: inline-block;">
                    Kembali
                </a>
                <button type="submit"
                        style="background-color: #0d6efd; color: #ffffff; border: none; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                    {{ isset($berita) ? 'Update Berita' : 'Simpan Berita' }}
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT JAVASCRIPT UNTUK PREVIEW GAMBAR --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Memunculkan kotak gambar saat file dipilih
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
