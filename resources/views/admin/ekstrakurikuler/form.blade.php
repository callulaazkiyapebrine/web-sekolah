@extends('admin_app')

@section('title', isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')

@section('content')
<div style="padding: 15px 20px;">
    <!-- Container Utama Putih Bersih Card -->
    <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); max-width: 1000px; margin: 0 auto;">

        {{-- HEADER --}}
        <div style="margin-bottom: 20px;">
            <h4 style="font-weight: 700; color: #1e293b; margin: 0 0 4px 0; font-size: 18px;">
                {{ isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}
            </h4>
            <p style="color: #64748b; font-size: 13px; margin: 0;">
                {{ isset($ekstrakurikuler) ? 'Isi form di bawah untuk memperbarui kegiatan ekstrakurikuler' : 'Isi form di bawah untuk menambah kegiatan ekstrakurikuler' }}
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
        <form action="{{ isset($ekstrakurikuler) && $ekstrakurikuler ? route('admin.ekstrakurikuler.save', Crypt::encrypt($ekstrakurikuler->id_ekskul ?? $ekstrakurikuler->id)) : route('admin.ekstrakurikuler.save') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- GRID 2 KOLOM (BARIS 1: NAMA & PEMBINA) --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-weight: 500; color: #334155; font-size: 13px; margin-bottom: 6px;">
                        Nama Ekstrakurikuler <span style="color: red;">*</span>
                    </label>
                    <input type="text" name="nama_ekskul" value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul ?? '') }}" required placeholder=""
                           style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #334155; outline: none;">
                </div>

                <div>
                    <label style="display: block; font-weight: 500; color: #334155; font-size: 13px; margin-bottom: 6px;">
                        Pembina
                    </label>
                    <input type="text" name="pembina" value="{{ old('pembina', $ekstrakurikuler->pembina ?? '') }}" placeholder=""
                           style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #334155; outline: none;">
                </div>
            </div>

            {{-- GRID 2 KOLOM (BARIS 2: JADWAL & GAMBAR) --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                <div>
                    <label style="display: block; font-weight: 500; color: #334155; font-size: 13px; margin-bottom: 6px;">
                        Jadwal Latihan
                    </label>
                    <input type="text" name="jadwal_latihan" value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan ?? '') }}" placeholder=""
                           style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #334155; outline: none;">
                </div>

                <div>
                    <label style="display: block; font-weight: 500; color: #334155; font-size: 13px; margin-bottom: 6px;">
                        Gambar
                    </label>

                    {{-- Area Pratinjau Gambar (Live Preview) --}}
                    <div style="margin-bottom: 8px;">
                        <img id="imagePreview"
                             src="{{ isset($ekstrakurikuler) && $ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)) ? asset('storage/' . $ekstrakurikuler->gambar) : '#' }}"
                             alt="Pratinjau Gambar"
                             style="width: 90px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; {{ isset($ekstrakurikuler) && $ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)) ? '' : 'display: none;' }}">
                    </div>

                    <input type="file" name="gambar" id="fotoInput" accept="image/*" onchange="previewImage(event)"
                           style="width: 100%; padding: 6px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #334155; background: #fff;">
                    <span style="display: block; font-size: 11px; color: #64748b; margin-top: 4px;">Format: JPG, PNG. Max: 2MB</span>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 500; color: #334155; font-size: 13px; margin-bottom: 6px;">
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="5" placeholder=""
                          style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #334155; outline: none;">{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
            </div>

            {{-- TOMBOL AKSI (POSISI DI KIRI) --}}
            <div style="display: flex; justify-content: flex-start; gap: 8px;">
                <button type="submit"
                        style="background-color: #0284c7; color: #ffffff; border: none; padding: 8px 20px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fas fa-check-circle"></i> {{ isset($ekstrakurikuler) ? 'Simpan Perubahan' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.ekstrakurikuler.index') }}"
                   style="background-color: #ffffff; color: #334155; border: 1px solid #cbd5e1; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fas fa-times-circle" style="color: #64748b;"></i> Batal
                </a>
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
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
