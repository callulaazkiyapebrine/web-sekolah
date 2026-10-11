@extends('admin_app')

@section('title', 'Data Guru')

@section('content')
    <div style="padding: 15px 20px;">
        <!-- Container Utama Putih Bersih Card -->
        <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">

            {{-- HEADER: Judul di Kiri & Tombol Tambah di Kanan Atas (Hanya untuk Admin) --}}
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e9ecef;">
                <div>
                    <h4 style="font-weight: 700; color: #212529; margin: 0 0 4px 0; font-size: 18px;">Data Guru</h4>
                    <p style="color: #6c757d; font-size: 13px; margin: 0;">Daftar data guru sekolah.</p>
                </div>

                @if (auth()->check() && strtolower(auth()->user()->role) === 'admin')
                    <div>
                        <a href="{{ route('admin.guru.addEdit') }}"
                            style="display: inline-block; background-color: #0d6efd; color: #ffffff; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                            + Tambah Guru
                        </a>
                    </div>
                @endif
            </div>

            {{-- TABEL DATA --}}
            <div class="table-responsive">
                <table id="tableGuru" class="table table-hover align-middle w-100">

                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th>FOTO</th>
                            <th>NAMA GURU</th>
                            <th>NIP</th>
                            <th>MATA PELAJARAN</th>
                            <th class="text-center" style="width: 150px;">AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($guru as $item)
                            <tr>
                                {{-- NOMOR --}}
                                <td class="text-center fw-semibold text-secondary">{{ $loop->iteration }}</td>

                                {{-- FOTO --}}
                                <td>
                                    @if (!empty($item->foto) && file_exists(public_path('storage/' . $item->foto)))
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto"
                                            style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_guru ?? 'Guru') }}&background=random"
                                            alt="Avatar"
                                            style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                    @endif
                                </td>

                                {{-- NAMA GURU --}}
                                <td>
                                    <div style="font-weight: 600; color: #212529; font-size: 14px;">
                                        {{ $item->nama_guru ?? ($item->nama ?? ($item->name ?? '-')) }}
                                    </div>
                                </td>

                                {{-- NIP --}}
                                <td style="font-size: 14px; color: #495057;">{{ $item->nip ?? '-' }}</td>

                                {{-- MATA PELAJARAN --}}
                                <td style="font-size: 14px; color: #495057;">{{ $item->mapel ?? '-' }}</td>

                                {{-- AKSI --}}
                                <td class="text-center">
                                    @if (auth()->check() && strtolower(auth()->user()->role) === 'admin')
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                                            {{-- DETAIL --}}
                                            <a href="{{ route('admin.guru.show', $item->id_guru) }}"
                                                style="display: inline-block; background-color: #17a2b8; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                                title="Detail">
                                                Detail
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.guru.addEdit', $item->id_guru) }}"
                                                style="display: inline-block; background-color: #ffc107; color: #000000; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                                title="Edit">
                                                Edit
                                            </a>

                                            {{-- HAPUS --}}
                                            <form action="{{ route('admin.guru.destroy', $item->id_guru) }}" method="POST"
                                                style="display: inline-block; margin: 0; padding: 0;"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada data guru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

{{-- DATATABLES SCRIPT --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            if (typeof $ === 'undefined' || !$.fn.DataTable) {
                return;
            }

            if ($.fn.DataTable.isDataTable('#tableGuru')) {
                $('#tableGuru').DataTable().destroy();
            }

            $('#tableGuru').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [],

                columnDefs: [{
                    targets: [0, 1, 5],
                    orderable: false,
                    searchable: false
                }],

                language: {
                    search: 'Cari:',
                    searchPlaceholder: '...',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data yang ditampilkan',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Belum ada data guru',

                    paginate: {
                        previous: 'Kembali',
                        next: 'Lanjut'
                    }
                }
            });
        });
    </script>
@endpush
