@extends('admin_app')

@section('title', 'Data Galeri')

@section('content')
<div style="background-color: #ffffff; padding: 28px; border-radius: 16px; box-shadow: 0 20px 27px 0 rgba(0,0,0,0.05); margin-bottom: 24px;">

    <!-- HEADER & TOMBOL TAMBAH -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid #e9ecef; padding-bottom: 16px;">
        <div>
            <h4 style="margin: 0; font-weight: bold; color: #1e293b; font-size: 1.25rem;">Data Galeri Sekolah</h4>
            <p style="margin: 4px 0 0 0; color: #64748b; font-size: 0.875rem;">Kelola dokumentasi foto dan video kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.galeri.addEdit') }}"
           style="background: linear-gradient(310deg, #0284c7, #0369a1); color: #ffffff; text-decoration: none; padding: 10px 18px; border-radius: 8px; font-weight: bold; font-size: 0.875rem; display: inline-block; box-shadow: 0 4px 6px rgba(2,132,199,.2);">
            + Tambah Galeri
        </a>
    </div>

    <!-- NOTIFIKASI SUKSES / ERROR (AUTO-HIDE 3 DETIK) -->
    @if(session('success'))
        <div id="alertNotification" style="background-color: #d1e7dd; border: 1px solid #badbcc; color: #0f5132; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; transition: opacity 0.5s ease;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="alertNotification" style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; transition: opacity 0.5s ease;">
            {{ session('error') }}
        </div>
    @endif

    <!-- TABEL DATA -->
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
            <thead>
                <tr style="border-bottom: 2px solid #e9ecef; color: #64748b; text-transform: uppercase; font-size: 0.75rem;">
                    <th style="padding: 12px; width: 50px; text-align: center;">NO</th>
                    <th style="padding: 12px; text-align: center; width: 100px;">PREVIEW</th>
                    <th style="padding: 12px;">JUDUL</th>
                    <th style="padding: 12px; text-align: center;">KATEGORI</th>
                    <th style="padding: 12px; text-align: center;">TANGGAL</th>
                    <th style="padding: 12px; text-align: center; width: 220px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galeri as $index => $item)
                    <tr style="border-bottom: 1px solid #e9ecef;">
                        <td style="padding: 12px; text-align: center; color: #334155; font-weight: 600;">
                            {{ $loop->iteration }}
                        </td>

                        <!-- KOLOM PREVIEW (HANDLE FOTO & VIDEO) -->
                        <td style="padding: 12px; text-align: center;">
                            @if ($item->kategori == 'Video')
                                @php
                                    $videoId = '';
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $item->file, $match)) {
                                        $videoId = $match[1];
                                    }
                                @endphp

                                @if($videoId)
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg"
                                         alt="Thumbnail Video"
                                         style="width: 80px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                                @else
                                    <span style="background-color: #f1f5f9; color: #334155; padding: 4px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: bold;">
                                        Video
                                    </span>
                                @endif
                            @else
                                @if ($item->file && file_exists(public_path('storage/' . $item->file)))
                                    <img src="{{ asset('storage/' . $item->file) }}"
                                         alt="Foto"
                                         style="width: 80px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                                @else
                                    <span style="background-color: #f1f5f9; color: #64748b; padding: 4px 8px; border-radius: 6px; font-size: 0.75rem;">
                                        No File
                                    </span>
                                @endif
                            @endif
                        </td>

                        <td style="padding: 12px; color: #334155; font-weight: 600;">
                            {{ $item->judul }}
                        </td>

                        <td style="padding: 12px; text-align: center;">
                            <span style="background-color: {{ $item->kategori == 'Video' ? '#e0f2fe' : '#dcfce7' }}; color: {{ $item->kategori == 'Video' ? '#0369a1' : '#15803d' }}; padding: 4px 10px; border-radius: 6px; font-weight: bold; font-size: 0.75rem;">
                                {{ $item->kategori }}
                            </span>
                        </td>

                        <td style="padding: 12px; text-align: center; color: #64748b;">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                        </td>

                        <!-- TOMBOL AKSI -->
                        <td style="padding: 12px; text-align: center; white-space: nowrap;">
                            <div style="display: inline-flex; gap: 4px; justify-content: center; align-items: center;">
                                <a href="{{ route('admin.galeri.show', Crypt::encrypt($item->id_galeri)) }}"
                                   style="background-color: #17a2b8; color: #fff; padding: 6px 10px; border-radius: 6px; text-decoration: none; font-size: 0.75rem; font-weight: bold; display: inline-block;">
                                    Detail
                                </a>
                                <a href="{{ route('admin.galeri.addEdit', Crypt::encrypt($item->id_galeri)) }}"
                                   style="background-color: #ffc107; color: #000; padding: 6px 10px; border-radius: 6px; text-decoration: none; font-size: 0.75rem; font-weight: bold; display: inline-block;">
                                    Edit
                                </a>
                                <form action="{{ route('admin.galeri.delete', Crypt::encrypt($item->id_galeri)) }}"
                                      method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                      style="display: inline-block; margin: 0; padding: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="background-color: #dc3545; color: #fff; border: none; padding: 6px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: bold; cursor: pointer; display: inline-block;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 24px; text-align: center; color: #64748b;">
                            Belum ada data galeri yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Auto-hide notifikasi setelah 3 detik
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function() {
            const alertEl = document.getElementById('alertNotification');
            if (alertEl) {
                alertEl.style.opacity = '0';
                setTimeout(() => alertEl.remove(), 500);
            }
        }, 3000);
    });
</script>
@endsection
