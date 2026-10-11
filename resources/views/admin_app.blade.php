<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <title>@yield('title', 'Dashboard') - SDN PASIRSALAM</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Font Awesome CDN CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet">

    <!-- DATATABLES CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Tailwind CSS (CDN Fallback) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <!-- Soft UI -->
    <link href="{{ asset('css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet">

    <!-- ALPINE.JS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- CUSTOM STYLING DATATABLES & ALPINE CLOAK -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        .dataTables_wrapper {
            padding: 1rem 0;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.375rem !important;
            padding: 0.25rem 2rem 0.25rem 0.75rem !important;
            margin: 0 0.5rem !important;
            background-color: #fff !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.375rem !important;
            padding: 0.375rem 0.75rem !important;
            margin-left: 0.5rem !important;
            outline: none !important;
            background-color: #fff !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #0284c7 !important;
            box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.2) !important;
        }

        table.dataTable {
            width: 100% !important;
            margin-top: 0.75rem !important;
            margin-bottom: 0.75rem !important;
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            font-weight: 700 !important;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
        }

        table.dataTable tbody td {
            padding: 0.75rem 1rem !important;
            border-bottom: 1px solid #f1f5f9 !important;
            vertical-align: middle !important;
        }

        .dataTables_wrapper .dataTables_info {
            float: left;
            padding-top: 0.85em;
            color: #64748b !important;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
            padding-top: 0.5em;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem !important;
            margin-left: 0.25rem !important;
            border-radius: 0.375rem !important;
            border: 1px solid #e2e8f0 !important;
            background: #fff !important;
            color: #334155 !important;
            font-size: 0.875rem !important;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #0284c7 !important;
            color: #ffffff !important;
            border-color: #0284c7 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f5f9 !important;
            color: #0f172a !important;
        }

        .dataTables_wrapper::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>

    @stack('styles')
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY BACKGROUND SAAT SIDEBAR MUNCUL DI MOBILE -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak
         class="fixed inset-0 z-980 bg-slate-900/50 transition-opacity xl:hidden"></div>

    <!-- SIDEBAR -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full xl:translate-x-0'"
        class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-xl transition-transform duration-300 xl:left-0">

        <!-- LOGO & BRAND SIDEBAR -->
        <div class="h-19.5 flex items-center justify-between px-6">
            <a class="flex items-center m-0 text-sm whitespace-nowrap text-slate-700 font-bold"
                href="{{ route('admin.dashboard') }}">
                @php
                    $profilLayout = \Illuminate\Support\Facades\Schema::hasTable('profil_sekolahs')
                        ? \DB::table('profil_sekolahs')->first()
                        : null;
                @endphp

                @if ($profilLayout && $profilLayout->logo && file_exists(public_path('storage/' . $profilLayout->logo)))
                    <img src="{{ asset('storage/' . $profilLayout->logo) }}" alt="Logo Sekolah"
                        style="width:36px; height:36px; object-fit:contain;" class="drop-shadow-sm">
                @else
                    <img src="https://raw.githubusercontent.com/PKM-KC-2021/Assets/main/Tutwuri.png"
                        alt="Logo Tut Wuri Handayani" style="width:36px; height:36px; object-fit:contain;"
                        class="drop-shadow-sm"
                        onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Tut_Wuri_Handayani.png/240px-Logo_Tut_Wuri_Handayani.png';">
                @endif

                <span class="ml-3 font-bold text-slate-800 uppercase tracking-wider text-xs truncate">
                    {{ $profilLayout->nama_sekolah ?? 'SDN PASIRSALAM' }}
                </span>
            </a>

            <!-- TOMBOL CLOSE SIDEBAR DI MOBILE -->
            <button @click="sidebarOpen = false" class="xl:hidden text-slate-400 hover:text-slate-700 p-1">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">

        <!-- MENU SIDEBAR -->
        <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full pb-10">
            <ul class="flex flex-col pl-0 mb-0">

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.dashboard') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-home text-sm"></i>
                        </div>
                        <span class="ml-1">Dashboard</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.profile-sekolah.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.profile-sekolah*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.profile-sekolah*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-school text-sm"></i>
                        </div>
                        <span class="ml-1">Profile Sekolah</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.guru.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.guru*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.guru*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-chalkboard-teacher text-sm"></i>
                        </div>
                        <span class="ml-1">Kelola Guru</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.siswa.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.siswa*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.siswa*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-user-graduate text-sm"></i>
                        </div>
                        <span class="ml-1">Kelola Siswa</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.berita.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.berita*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.berita*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-newspaper text-sm"></i>
                        </div>
                        <span class="ml-1">Kelola Berita</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.ekstrakurikuler.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.ekstrakurikuler*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.ekstrakurikuler*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-running text-sm"></i>
                        </div>
                        <span class="ml-1">Kelola Ekstrakulikuler</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.galeri.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.galeri*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.galeri*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-images text-sm"></i>
                        </div>
                        <span class="ml-1">Kelola Galeri</span>
                    </a>
                </li>

                {{-- KELOLA USER HANYA MUNCUL JIKA ROLE ADMIN --}}
                @if(auth()->check() && strtolower(auth()->user()->role) === 'admin')
                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.user.index') }}"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors {{ request()->routeIs('admin.user*') ? 'bg-sky-50 font-semibold text-sky-800 shadow-soft-xl' : 'hover:bg-slate-100' }}">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg {{ request()->routeIs('admin.user*') ? 'bg-sky-600 text-white' : 'bg-white text-slate-700 border border-gray-100' }}">
                            <i class="fas fa-users-cog text-sm"></i>
                        </div>
                        <span class="ml-1">Kelola User</span>
                    </a>
                </li>
                @endif

                <li class="w-full mt-4">
                    <hr class="h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent my-0">
                </li>

                <!-- TOMBOL LIHAT LANDING PAGE -->
                <li class="mt-2 w-full">
                    <a href="{{ route('beranda') }}" target="_blank"
                        class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 text-emerald-600 transition-colors hover:bg-emerald-50">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                            <i class="fas fa-globe text-sm"></i>
                        </div>
                        <span class="ml-1 font-semibold">Lihat Landing Page</span>
                    </a>
                </li>

                <!-- TOMBOL LOGOUT -->
                <li class="mt-1 w-full">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                            class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center w-[calc(100%-2rem)] whitespace-nowrap rounded-lg px-4 text-red-600 transition-colors hover:bg-red-50 text-left cursor-pointer">
                            <div
                                class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600">
                                <i class="fas fa-sign-out-alt text-sm"></i>
                            </div>
                            <span class="ml-1 font-semibold">Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="ease-soft-in-out xl:ml-68.5 relative min-h-screen rounded-xl transition-all duration-200">

        <!-- NAVBAR -->
        <nav
            class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">

                <div class="flex items-center gap-3">
                    <!-- TOMBOL HAMBURGER UNTUK MEMBUKA SIDEBAR DI MOBILE -->
                    <button @click="sidebarOpen = !sidebarOpen" class="xl:hidden text-slate-700 text-lg p-1 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div>
                        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                            <li class="text-sm leading-normal">
                                <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                            </li>
                            <li
                                class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                                @yield('breadcrumb', 'Dashboard')
                            </li>
                        </ol>
                        <h6 class="mb-0 font-bold capitalize">@yield('title', 'Dashboard')</h6>
                    </div>
                </div>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                            <span
                                class="text-sm absolute z-50 -ml-px flex h-full items-center rounded-lg bg-transparent py-2 px-2.5 text-slate-500">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text"
                                class="pl-8.75 text-sm w-full rounded-lg border border-solid border-gray-300 bg-white py-2 pr-3 text-gray-700"
                                placeholder="Cari...">
                        </div>
                    </div>

                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none">
                        <li class="flex items-center">
                            <a href="javascript:;"
                                class="block px-0 py-2 text-sm font-semibold transition-all text-slate-500">
                                <i class="fas fa-user mr-1"></i>
                                <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <!-- KONTEN DINAMIS -->
        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')
        </div>

        <!-- FOOTER -->
        <footer class="pt-4">
            <div class="w-full px-6 mx-auto">
                <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                    <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-1/2">
                        <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                            © {{ date('Y') }} {{ $profilLayout->nama_sekolah ?? 'SDN PASIRSALAM' }}
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </main>

    <!-- SCRIPTS CORE -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- TEMPLATE PLUGINS -->
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}"></script>

    <!-- AUTOMATISASI DATATABLES FLEXIBLE -->
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';

            $('table').each(function() {
                var $table = $(this);

                if ($table.find('thead').length === 0) {
                    var $firstRow = $table.find('tr').first();
                    if ($firstRow.length > 0) {
                        var $thead = $('<thead></thead>').append($firstRow);
                        $table.prepend($thead);
                    }
                }

                if ($table.find('tbody').length === 0) {
                    var $rows = $table.find('tr').not($table.find('thead tr'));
                    var $tbody = $('<tbody></tbody>').append($rows);
                    $table.append($tbody);
                }

                var totalTh = $table.find('thead th').length;
                if (totalTh > 0) {
                    $table.find('tbody tr').each(function() {
                        var $tds = $(this).find('td');
                        if ($tds.length === 1 && $tds.attr('colspan')) {
                            $(this).remove();
                        }
                    });
                }

                if (!$.fn.DataTable.isDataTable(this)) {
                    try {
                        $table.DataTable({
                            "language": {
                                "search": "Cari:",
                                "lengthMenu": "Tampilkan _MENU_ data",
                                "zeroRecords": "Belum ada data yang tersimpan",
                                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                                "infoEmpty": "Menampilkan 0 data",
                                "infoFiltered": "(disaring dari _MAX_ total data)",
                                "paginate": {
                                    "next": "Lanjut",
                                    "previous": "Kembali"
                                }
                            },
                            "pageLength": 10,
                            "responsive": true,
                            "autoWidth": false,
                            "destroy": true
                        });
                    } catch (e) {
                        console.log("Inisialisasi DataTables lewati tabel ini:", e);
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
