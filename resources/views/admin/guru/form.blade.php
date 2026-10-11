@extends('admin_app')

@section('title', isset($guru) ? 'Edit Data Guru' : 'Tambah Data Guru')

@section('content')
    <div style="background-color: #ffffff; padding: 28px; border-radius: 16px; box-shadow: 0 20px 27px 0 rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto 24px auto;">

        <!-- HEADER FORM -->
        <div style="margin-bottom: 24px; border-bottom: 1px solid #e9ecef; padding-bottom: 16px;">
            <h4 style="margin: 0; font-weight: bold; color: #0f172a; font-size: 1.25rem;">
                {{ isset($guru) ? 'Form Edit Data Guru' : 'Form Tambah Data Guru Baru' }}
            </h4>
            <p style="margin: 4px 0 0 0; color: #64748b; font-size: 0.875rem;">
                Silakan isi formulir di bawah ini dengan lengkap dan benar.
            </p>
        </div>

        <!-- NOTIFIKASI ERROR VALIDASI -->
        @if ($errors->any())
            <div style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM UTAMA -->
        <form action="{{ isset($guru) && $guru ? route('admin.guru.save', Crypt::encrypt($guru->id_guru)) : route('admin.guru.save') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <!-- NAMA LENGKAP GURU -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                    Nama Lengkap Guru <span style="color: red;">*</span>
                </label>
                <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru ?? '') }}" required
                    placeholder="Contoh: Drs. Ahmad Dahlan, M.Pd."
                    style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none;">
            </div>

            <!-- NIP -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                    NIP (Nomor Induk Pegawai) <span style="color: #64748b; font-weight: normal;">(Opsional)</span>
                </label>
                <input type="text" name="nip" value="{{ old('nip', $guru->nip ?? '') }}"
                    placeholder="Contoh: 19850101 201001 1 001"
                    style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none;">
            </div>

            <!-- MATA PELAJARAN -->
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                    Mata Pelajaran <span style="color: red;">*</span>
                </label>
                <input type="text" name="mapel" value="{{ old('mapel', $guru->mapel ?? '') }}" required
                    placeholder="Contoh: Pemrograman Web & Perangkat Bergerak"
                    style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none;">
            </div>

            <!-- FOTO GURU & PREVIEW -->
            <div style="margin-bottom: 28px;">
                <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                    Foto Guru <span style="color: #64748b; font-weight: normal;">(Opsional, format: JPG, PNG, WEBP, maks: 2MB)</span>
                </label>

                {{-- Area Pratinjau Foto (Live Preview) --}}
                <div style="margin-bottom: 12px;">
                    <img id="imagePreview"
                         src="{{ isset($guru) && $guru->foto && file_exists(public_path('storage/' . $guru->foto)) ? asset('storage/' . $guru->foto) : '#' }}"
                         alt="Pratinjau Foto"
                         style="width: 90px; height: 90px; object-fit: cover; border-radius: 50%; border: 2px solid #cbd5e1; {{ isset($guru) && $guru->foto && file_exists(public_path('storage/' . $guru->foto)) ? '' : 'display: none;' }}">
                </div>

                <input type="file" name="foto" id="fotoInput" accept="image/*" onchange="previewImage(event)"
                    style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155;">
            </div>

            <!-- TOMBOL AKSI -->
            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('admin.guru.index') }}"
                    style="background-color: #64748b; color: #ffffff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 0.875rem;">
                    Kembali
                </a>
                <button type="submit"
                    style="background: linear-gradient(310deg, #0284c7, #0369a1); color: #ffffff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; font-size: 0.875rem; cursor: pointer; box-shadow: 0 4px 6px rgba(2,132,199,.2);">
                    {{ isset($guru) && $guru ? 'Update Data Guru' : 'Simpan Data Guru' }}
                </button>
            </div>
        </form>
    </div>
@endsection

{{-- SCRIPT JAVASCRIPT UNTUK PREVIEW FOTO --}}
@push('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Memunculkan lingkaran foto saat file dipilih
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
