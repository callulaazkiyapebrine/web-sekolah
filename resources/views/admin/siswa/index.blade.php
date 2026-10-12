@extends('admin_app')

@section('title', 'Data Siswa')

@section('content')
<div style="padding: 15px 20px;">
    <!-- Container Utama Putih Bersih Card -->
    <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">

        {{-- HEADER: Judul di Kiri & Tombol Tambah di Kanan Atas (Hanya untuk Admin) --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e9ecef;">
            <div>
                <h4 style="font-weight: 700; color: #212529; margin: 0 0 4px 0; font-size: 18px;">Data Siswa</h4>
                <p style="color: #6c757d; font-size: 13px; margin: 0;">Daftar data siswa sekolah.</p>
            </div>

            @if(auth()->check() && strtolower(auth()->user()->role) === 'admin')
            <div>
                <a href="{{ route('admin.siswa.addEdit') }}"
                   style="display: inline-block; background-color: #0d6efd; color: #ffffff; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                    + Tambah Siswa
                </a>
            </div>
            @endif
        </div>

        {{-- NOTIFIKASI SUKSES (AUTO-HIDE 3 DETIK) --}}
        @if (session('success'))
            <div id="success-alert" style="background-color: #d1e7dd; border: 1px solid #badbcc; color: #0f5132; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- NOTIFIKASI ERROR --}}
        @if (session('error'))
            <div style="background-color: #f8d7da; border: 1px solid #f5c2c7; color: #842029; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- TABEL DATA --}}
        <div class="table-responsive">
            <table id="tableSiswa" class="table table-hover align-middle nowrap w-100">

                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">NO</th>
                        <th>NISN</th>
                        <th>NAMA SISWA</th>
                        <th>KELAS</th>
                        <th>JENIS KELAMIN</th>
                        <th>TAHUN MASUK</th>
                        <th class="text-center" style="width: 150px;">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($siswa as $item)
                        @php
                            $namaSiswa = $item->nama_siswa ?? $item->nama ?? $item->name ?? '-';
                            $nisn = $item->nisn ?? $item->nis ?? $item->nis_nisn ?? '-';
                            $kelas = $item->kelas ?? '-';
                            $jk = $item->jenis_kelamin ?? $item->jk ?? '-';
                            $tahunMasuk = $item->tahun_masuk ?? $item->angkatan ?? '-';
                            $siswaId = $item->id_siswa ?? $item->id;
                        @endphp
                        <tr>
                            {{-- NOMOR --}}
                            <td class="text-center fw-semibold text-secondary">{{ $loop->iteration }}</td>

                            {{-- NISN --}}
                            <td style="font-size: 14px; color: #495057;">{{ $nisn }}</td>

                            {{-- NAMA SISWA --}}
                            <td>
                                <div style="font-weight: 600; color: #212529; font-size: 14px;">
                                    {{ $namaSiswa }}
                                </div>
                            </td>

                            {{-- KELAS --}}
                            <td style="font-size: 14px; color: #495057;">{{ $kelas }}</td>

                            {{-- JENIS KELAMIN --}}
                            <td style="font-size: 14px; color: #495057;">{{ $jk }}</td>

                            {{-- TAHUN MASUK --}}
                            <td style="font-size: 14px; color: #495057;">{{ $tahunMasuk }}</td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                @if(auth()->check() && strtolower(auth()->user()->role) === 'admin')
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                                        {{-- DETAIL (Menggunakan Crypt::encrypt agar cocok dengan Controller) --}}
                                        <a href="{{ route('admin.siswa.show', Crypt::encrypt($siswaId)) }}"
                                           style="display: inline-block; background-color: #17a2b8; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                           title="Detail">
                                            Detail
                                        </a>

                                        {{-- EDIT (Menggunakan Crypt::encrypt agar cocok dengan Controller) --}}
                                        <a href="{{ route('admin.siswa.addEdit', Crypt::encrypt($siswaId)) }}"
                                           style="display: inline-block; background-color: #ffc107; color: #000000; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                           title="Edit">
                                            Edit
                                        </a>

                                        {{-- HAPUS (Menggunakan Crypt::encrypt agar cocok dengan Controller) --}}
                                        <form action="{{ route('admin.siswa.delete', Crypt::encrypt($siswaId)) }}"
                                              method="POST"
                                              style="display: inline-block; margin: 0; padding: 0;"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="background-color: #dc3545; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; border: none; cursor: pointer;"
                                                    title="Hapus">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span style="color: #6c757d; font-weight: 600;">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

{{-- DATATABLES SCRIPT & AUTO-HIDE ALERT --}}
@push('scripts')
    <script>
        $(document).ready(function () {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                setTimeout(function () {
                    alertBox.style.transition = 'opacity 0.5s ease';
                    alertBox.style.opacity = '0';
                    setTimeout(function () {
                        alertBox.style.display = 'none';
                    }, 500);
                }, 3000);
            }

            if (typeof $ === 'undefined' || !$.fn.DataTable) {
                return;
            }

            if ($.fn.DataTable.isDataTable('#tableSiswa')) {
                $('#tableSiswa').DataTable().destroy();
            }

            $('#tableSiswa').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [],

                columnDefs: [
                    {
                        targets: [0, 6],
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {
                    search: 'Cari:',
                    searchPlaceholder: '...',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Belum ada data siswa',

                    paginate: {
                        previous: 'Kembali',
                        next: 'Lanjut'
                    }
                }
            });
        });
    </script>
@endpush