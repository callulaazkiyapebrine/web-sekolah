@extends('admin_app')

@section('title', 'User')

@section('content')
<div style="padding: 15px 20px;">
    <!-- Container Utama Putih Bersih Card -->
    <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">

        {{-- HEADER: Judul Kiri & Tombol Tambah Kanan Atas --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e9ecef;">
            <div>
                <h4 style="font-weight: 700; color: #212529; margin: 0 0 4px 0; font-size: 18px;">Data User Sistem</h4>
                <p style="color: #6c757d; font-size: 13px; margin: 0;">Kelola daftar akun dan hak akses pengguna sekolah.</p>
            </div>
            <div>
                <a href="{{ route('admin.user.addEdit') }}"
                   style="display: inline-block; background-color: #0d6efd; color: #ffffff; padding: 8px 18px; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                    + Tambah User
                </a>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <div class="table-responsive">
            <table id="tableUser" class="table table-hover align-middle nowrap w-100">

                <thead class="table-light">
                    <tr>
                        <th class="text-center" data-priority="1" style="width: 50px;">NO</th>
                        <th data-priority="1">NAMA</th>
                        <th data-priority="3">EMAIL</th>
                        <th class="text-center" data-priority="2" style="width: 130px;">ROLE</th>
                        <th class="text-center" data-priority="1" style="width: 220px;">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            {{-- NOMOR --}}
                            <td class="text-center fw-semibold text-secondary">{{ $loop->iteration }}</td>

                            {{-- NAMA --}}
                            <td>
                                <div class="fw-bold text-dark" style="font-size: 14px;">{{ $item->name }}</div>
                                <small class="text-muted" style="font-size: 12px;">Username: {{ $item->username ?? '-' }}</small>
                            </td>

                            {{-- EMAIL --}}
                            <td class="text-dark" style="font-size: 14px;">{{ $item->email }}</td>

                            {{-- ROLE --}}
                            <td class="text-center">
                                @if (strcasecmp($item->role ?? '', 'admin') === 0)
                                    <span style="display: inline-block; background-color: #e7f1ff; color: #0d6efd; padding: 4px 12px; border-radius: 50px; font-weight: 600; font-size: 12px;">
                                        Admin
                                    </span>
                                @else
                                    <span style="display: inline-block; background-color: #e2e3e5; color: #41464b; padding: 4px 12px; border-radius: 50px; font-weight: 600; font-size: 12px;">
                                        Operator
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI (Tombol Detail, Edit, Hapus) --}}
                            <td class="text-center">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.user.show', Crypt::encrypt($item->id)) }}"
                                       style="display: inline-block; background-color: #17a2b8; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                       title="Detail User">
                                        Detail
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.user.addEdit', Crypt::encrypt($item->id)) }}"
                                       style="display: inline-block; background-color: #ffc107; color: #000000; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                       title="Edit User">
                                        Edit
                                    </a>

                                    {{-- HAPUS --}}
                                    @if ((int) $item->id !== (int) auth()->id())
                                        <form action="{{ route('admin.user.delete', Crypt::encrypt($item->id)) }}"
                                              method="POST"
                                              style="display: inline-block; margin: 0; padding: 0;"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="background-color: #dc3545; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; border: none; cursor: pointer;"
                                                    title="Hapus User">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <button type="button"
                                                style="background-color: #6c757d; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; border: none; cursor: not-allowed;"
                                                disabled
                                                title="Akun yang sedang login tidak dapat dihapus">
                                            Terkunci
                                        </button>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Belum ada data user.
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
        $(document).ready(function () {
            if (typeof $ === 'undefined' || !$.fn.DataTable) {
                return;
            }

            if ($.fn.DataTable.isDataTable('#tableUser')) {
                $('#tableUser').DataTable().destroy();
            }

            $('#tableUser').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                order: [],

                columnDefs: [
                    {
                        targets: [0, 4],
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
                    emptyTable: 'Belum ada data user',

                    paginate: {
                        previous: 'Kembali',
                        next: 'Lanjut'
                    }
                }
            });
        });
    </script>
@endpush
