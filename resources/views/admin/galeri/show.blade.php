@extends('admin_app')

@section('title', 'Detail Galeri')

@section('content')
<div style="background-color: #ffffff; padding: 28px; border-radius: 16px; box-shadow: 0 20px 27px 0 rgba(0,0,0,0.05); max-width: 850px; margin: 0 auto 24px auto;">

    <!-- HEADER -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid #e9ecef; padding-bottom: 16px;">
        <div>
            <h4 style="margin: 0; font-weight: bold; color: #344767; font-size: 1.25rem;">
                Detail {{ $galeri->kategori == 'Video' ? 'Video' : 'Foto' }} Galeri
            </h4>
            <p style="margin: 4px 0 0 0; color: #8392ab; font-size: 0.875rem;">
                Informasi dokumentasi {{ strtolower($galeri->kategori) }} kegiatan sekolah.
            </p>
        </div>
        <a href="{{ route('admin.galeri.index') }}"
           style="background-color: #6c757d; color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 8px; font-size: 0.875rem; font-weight: bold;">
            &larr; Kembali
        </a>
    </div>

    <!-- WADAH MEDIA (FOTO ATAU VIDEO YOUTUBE) -->
    <div style="background-color: #f8f9fa; border: 2px dashed #007bff; border-radius: 12px; padding: 16px; text-align: center; margin-bottom: 24px;">
        @if ($galeri->kategori == 'Video')
            @php
                // Ekstrak ID Video YouTube dari berbagai format link
                $videoId = '';
                if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $galeri->file, $match)) {
                    $videoId = $match[1];
                }
            @endphp

            @if($videoId)
                <!-- PEMUTAR VIDEO YOUTUBE -->
                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px;">
                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                            allowfullscreen>
                    </iframe>
                </div>
            @else
                <p style="color: #dc3545; font-weight: bold; margin: 20px 0;">
                    Link Video YouTube tidak valid atau rusak.<br>
                    <a href="{{ $galeri->file }}" target="_blank" style="color: #007bff;">Buka Link Asli</a>
                </p>
            @endif
        @else
            <!-- TAMPILAN FOTO -->
            @if($galeri->file && file_exists(public_path('storage/' . $galeri->file)))
                <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}"
                     style="max-width: 100%; height: auto; border-radius: 8px; max-height: 450px; object-fit: contain;">
            @else
                <div style="padding: 40px 0; color: #8392ab;">
                    <i class="fas fa-image" style="font-size: 48px; margin-bottom: 12px; color: #007bff;"></i>
                    <p style="margin: 0; font-weight: 600;">Foto tidak ditemukan</p>
                </div>
            @endif
        @endif
    </div>

    <!-- DETAIL INFORMASI -->
    <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
        <div style="background-color: #f8f9fa; padding: 12px 16px; border-radius: 8px; display: flex; justify-content: space-between;">
            <span style="color: #8392ab; font-size: 0.875rem;">Judul Kegiatan</span>
            <span style="font-weight: bold; color: #344767; font-size: 0.875rem;">{{ $galeri->judul }}</span>
        </div>

        <div style="background-color: #f8f9fa; padding: 12px 16px; border-radius: 8px; display: flex; justify-content: space-between;">
            <span style="color: #8392ab; font-size: 0.875rem;">Kategori</span>
            <span style="font-weight: bold; color: #007bff; font-size: 0.875rem;">{{ $galeri->kategori }}</span>
        </div>

        <div style="background-color: #f8f9fa; padding: 12px 16px; border-radius: 8px; display: flex; justify-content: space-between;">
            <span style="color: #8392ab; font-size: 0.875rem;">Tanggal Unggah</span>
            <span style="font-weight: bold; color: #344767; font-size: 0.875rem;">{{ \Carbon\Carbon::parse($galeri->tanggal)->translatedFormat('d F Y') }}</span>
        </div>

        <div style="background-color: #f8f9fa; padding: 16px; border-radius: 8px;">
            <span style="display: block; color: #8392ab; font-size: 0.875rem; margin-bottom: 6px;">Keterangan</span>
            <p style="margin: 0; color: #344767; font-size: 0.875rem; line-height: 1.5;">{{ $galeri->keterangan ?? '-' }}</p>
        </div>
    </div>

    <!-- TOMBOL AKSI -->
    <div style="display: flex; justify-content: flex-end; gap: 12px;">
        <a href="{{ route('admin.galeri.index') }}"
           style="background-color: #8392ab; color: #ffffff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 0.875rem;">
            Kembali
        </a>
        <a href="{{ route('admin.galeri.addEdit', Crypt::encrypt($galeri->id_galeri)) }}"
           style="background-color: #007bff; color: #ffffff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 0.875rem;">
            Edit Data
        </a>
    </div>
</div>
@endsection
