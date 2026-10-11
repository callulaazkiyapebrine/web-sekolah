@extends('admin_app')

@section('title', 'Kelola Berita')
@section('breadcrumb', 'Berita')

@section('content')
    <div class="bg-white rounded-2xl shadow-soft-xl border border-sky-100 p-5 md:p-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h5 class="text-xl font-bold text-sky-950 mb-1">
                    Kelola Berita & Informasi Sekolah
                </h5>

                <p class="text-sm text-slate-500">
                    Kelola dan publikasikan berita terbaru untuk informasi sekolah.
                </p>
            </div>

            @if(auth()->check() && strtolower(auth()->user()->role) === 'admin')
            <a href="{{ route('admin.berita.addEdit') }}"
               class="inline-flex items-center justify-center gap-2
                      bg-sky-600 hover:bg-sky-700 text-white
                      text-sm font-semibold px-4 py-2.5 rounded-xl
                      transition duration-200 shadow-sm">
                <i class="fas fa-plus"></i>
                Tambah Berita Baru
            </a>
            @endif
        </div>

        {{-- NOTIFIKASI SUKSES --}}
        @if (session('success'))
            <div class="mb-5 flex items-center gap-2 rounded-xl border border-emerald-200
                        bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- NOTIFIKASI ERROR --}}
        @if (session('error'))
            <div class="mb-5 flex items-center gap-2 rounded-xl border border-red-200
                        bg-red-50 px-4 py-3 text-sm text-red-700">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- TABEL BERITA --}}
        <div class="overflow-x-auto rounded-xl border border-slate-100">
            <table id="tableBerita"
                class="w-full min-w-[900px] text-sm text-left text-slate-600 border-collapse">

                <thead class="bg-sky-50 text-sky-900 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-4 text-center w-14">No</th>
                        <th class="px-4 py-4 text-center w-24">Gambar</th>
                        <th class="px-4 py-4">Judul & Isi</th>
                        <th class="px-4 py-4 w-32">Tanggal</th>
                        <th class="px-4 py-4 w-32">Penulis</th>
                        <th class="px-4 py-4 text-center w-36">Status</th>
                        <th class="px-4 py-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($berita as $item)
                        @php
                            $beritaId = $item->getKey();
                            $tanggalBerita = $item->tanggal ?? $item->created_at;
                            $statusBerita = strtolower((string) ($item->status ?? 'Dipublikasikan'));
                            $sudahPublikasi = in_array(
                                $statusBerita,
                                ['dipublikasikan', 'published', 'publish', '1', 'aktif'],
                                true
                            );
                        @endphp

                        <tr class="hover:bg-sky-50/50 transition-colors">

                            {{-- NOMOR --}}
                            <td class="px-4 py-4 text-center text-xs font-semibold text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            {{-- GAMBAR --}}
                            <td class="px-4 py-4 text-center">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="{{ $item->judul ?? 'Gambar berita' }}"
                                         loading="lazy"
                                         class="w-14 h-14 rounded-xl object-cover mx-auto
                                                border border-slate-200 shadow-sm">
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-slate-100
                                                flex items-center justify-center mx-auto
                                                border border-slate-200">
                                        <i class="fas fa-image text-xl text-slate-400"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- JUDUL DAN ISI --}}
                            <td class="px-4 py-4 max-w-sm">
                                <h6 class="font-bold text-slate-800 text-sm mb-1">
                                    {{ $item->judul ?? 'Tanpa judul' }}
                                </h6>

                                <p class="text-xs text-slate-500 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($item->isi ?? ''),
                                        70
                                    ) ?: 'Belum ada isi berita.' }}
                                </p>
                            </td>

                            {{-- TANGGAL --}}
                            <td class="px-4 py-4 text-xs text-slate-600 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <i class="far fa-calendar-alt text-sky-500"></i>
                                    <span>
                                        @if ($tanggalBerita)
                                            {{ \Carbon\Carbon::parse($tanggalBerita)->translatedFormat('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>
                            </td>

                            {{-- PENULIS --}}
                            <td class="px-4 py-4 text-xs font-medium text-slate-700">
                                {{ $item->user->name ?? 'Admin' }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-4 py-4 text-center">
                                @if ($sudahPublikasi)
                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 bg-emerald-50 text-emerald-700
                                                 border border-emerald-200
                                                 text-[11px] font-semibold whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Dipublikasikan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 bg-amber-50 text-amber-700
                                                 border border-amber-200
                                                 text-[11px] font-semibold whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        {{ $item->status ?? 'Draft' }}
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-3 py-4 text-center">
                                @if(auth()->check() && strtolower(auth()->user()->role) === 'admin')
                                    <div style="display: flex; items-center; justify-content: center; gap: 6px;">

                                        {{-- DETAIL --}}
                                        <a href="{{ url('admin/berita/show/' . $beritaId) }}"
                                           style="display: inline-block; background-color: #17a2b8; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                           title="Lihat detail berita">
                                            Detail
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ url('admin/berita/add-edit/' . $beritaId) }}"
                                           style="display: inline-block; background-color: #ffc107; color: #000000; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; text-decoration: none;"
                                           title="Edit berita">
                                            Edit
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ url('admin/berita/delete/' . $beritaId) }}"
                                              method="POST"
                                              style="display: inline-block; margin: 0; padding: 0;"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="background-color: #dc3545; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; border: none; cursor: pointer;"
                                                    title="Hapus berita">
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
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-2xl bg-sky-50
                                                flex items-center justify-center mb-3">
                                        <i class="fas fa-newspaper text-3xl text-sky-300"></i>
                                    </div>

                                    <h6 class="text-sm font-bold text-slate-700 mb-1">
                                        Belum Ada Berita
                                    </h6>

                                    <p class="text-xs text-slate-400">
                                        Silakan klik tombol Tambah Berita Baru untuk menambahkan berita.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- FOOTER --}}
        <div class="mt-4 text-xs text-slate-400">
            Total berita:
            <span class="font-semibold text-slate-600">
                {{ $berita->count() }}
            </span>
        </div>

    </div>
@endsection

{{-- DATATABLES --}}
@push('scripts')
    <script>
        $(document).ready(function () {
            if (typeof $ === 'undefined' || !$.fn.DataTable) {
                return;
            }

            if ($.fn.DataTable.isDataTable('#tableBerita')) {
                $('#tableBerita').DataTable().destroy();
            }

            $('#tableBerita').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                autoWidth: false,
                stateSave: false,
                order: [],

                columnDefs: [
                    {
                        targets: [0, 1, 6],
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {
                    search: 'Cari berita:',
                    searchPlaceholder: 'Ketik judul berita...',
                    lengthMenu: 'Tampilkan _MENU_ berita',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ berita',
                    infoEmpty: 'Belum ada data berita',
                    zeroRecords: 'Tidak ada berita yang cocok dengan pencarian.',
                    emptyTable: 'Belum ada berita yang ditambahkan.',

                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                }
            });
        });
    </script>
@endpush
