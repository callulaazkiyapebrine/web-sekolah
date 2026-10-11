@extends('admin_app')

@section('title', isset($galeri) ? 'Edit Data Galeri' : 'Tambah Data Galeri')

@section('content')
<div style="background-color: #ffffff; padding: 28px; border-radius: 16px; box-shadow: 0 20px 27px 0 rgba(0,0,0,0.05); max-width: 850px; margin: 0 auto 24px auto;">

    <div style="margin-bottom: 24px; border-bottom: 1px solid #e9ecef; padding-bottom: 16px;">
        <h4 style="margin: 0; font-weight: bold; color: #1e293b; font-size: 1.25rem;">
            {{ isset($galeri) ? 'Form Edit Data Galeri' : 'Tambah Data Galeri' }}
        </h4>
        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 0.875rem;">
            Isi formulir di bawah ini untuk menambahkan galeri sekolah.
        </p>
    </div>

    @if ($errors->any())
        <div style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.galeri.save', isset($galeri) ? Crypt::encrypt($galeri->id_galeri) : '') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                Judul Galeri (Maks 50 karakter) <span style="color: red;">*</span>
            </label>
            <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" required maxLength="50"
                   style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                Kategori <span style="color: red;">*</span>
            </label>
            <select name="kategori" id="kategoriSelect" onchange="switchInputMedia()" required
                    style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none; background-color: #fff;">
                <option value="Foto" {{ old('kategori', $galeri->kategori ?? '') == 'Foto' ? 'selected' : '' }}>Foto</option>
                <option value="Video" {{ old('kategori', $galeri->kategori ?? '') == 'Video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                Tanggal <span style="color: red;">*</span>
            </label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $galeri->tanggal ?? date('Y-m-d')) }}" required
                   style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                Keterangan
            </label>
            <textarea name="keterangan" rows="4"
                      style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none; resize: vertical;">{{ old('keterangan', $galeri->keterangan ?? '') }}</textarea>
        </div>

        <!-- INPUT FOTO -->
        <div id="sectionFoto" style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                Upload File Foto
            </label>
            @if (isset($galeri) && $galeri->kategori == 'Foto' && !empty($galeri->file) && file_exists(public_path('storage/' . $galeri->file)))
                <div style="margin-bottom: 12px;">
                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="Foto Galeri"
                         style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover; border: 1px solid #cbd5e1;">
                </div>
            @endif
            <input type="file" name="file" id="fieldFoto" accept="image/*"
                   style="width: 100%; padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155;">
        </div>

        <!-- INPUT LINK VIDEO -->
        <div id="sectionVideo" style="margin-bottom: 20px; display: none;">
            <label style="display: block; font-weight: 600; color: #1e293b; font-size: 0.875rem; margin-bottom: 8px;">
                Link Video YouTube <span style="color: red;">*</span>
            </label>
            <input type="text" name="file" id="fieldVideo" placeholder="https://www.youtube.com/watch?v=xxxxxx" value="{{ old('file', $galeri->file ?? '') }}"
                   style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.875rem; color: #334155; outline: none;">
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #e9ecef; padding-top: 20px;">
            <a href="{{ route('admin.galeri.index') }}"
               style="background-color: #64748b; color: #ffffff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 0.875rem;">
                Batal
            </a>
            <button type="submit"
                    style="background: linear-gradient(310deg, #0284c7, #0369a1); color: #ffffff; border: none; padding: 10px 24px; border-radius: 8px; font-weight: bold; font-size: 0.875rem; cursor: pointer; box-shadow: 0 4px 6px rgba(2,132,199,.2);">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    function switchInputMedia() {
        var kat = document.getElementById('kategoriSelect').value;
        var secFoto = document.getElementById('sectionFoto');
        var secVideo = document.getElementById('sectionVideo');
        var inFoto = document.getElementById('fieldFoto');
        var inVideo = document.getElementById('fieldVideo');

        if (kat === 'Video') {
            secVideo.style.display = 'block';
            secFoto.style.display = 'none';
            inFoto.disabled = true;
            inVideo.disabled = false;
        } else {
            secFoto.style.display = 'block';
            secVideo.style.display = 'none';
            inFoto.disabled = false;
            inVideo.disabled = true;
        }
    }

    // Eksekusi fungsi langsung saat halaman selesai di-render
    window.onload = switchInputMedia;
</script>
@endsection
