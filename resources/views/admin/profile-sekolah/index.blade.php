@extends('admin_app') {{-- Sesuaikan nama layout admin kamu --}}

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Profil Sekolah</h1>
        </div>
        <a href="{{ route('admin.profile-sekolah.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition flex items-center gap-2">
            <i class="fas fa-edit"></i> Edit Profil
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
        <h2 class="text-base font-bold text-gray-800 border-b pb-3">Informasi Sekolah</h2>

        <!-- Logo, Foto Gedung & Foto Kepala Sekolah -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Logo -->
            <div class="text-center">
                <p class="text-sm font-semibold text-gray-500 mb-3">Logo Sekolah</p>
                <div class="flex items-center justify-center h-48 bg-gray-50 rounded-lg p-4 border border-gray-100">
                    @php $logo = data_get($profil, 'logo'); @endphp
                    @if ($logo && file_exists(public_path('storage/' . $logo)))
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo Sekolah" class="max-h-36 object-contain">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Logo_Tut_Wuri_Handayani.png/240px-Logo_Tut_Wuri_Handayani.png" alt="Logo Default" class="max-h-36 object-contain">
                    @endif
                </div>
            </div>

            <!-- Foto Gedung -->
            <div class="text-center">
                <p class="text-sm font-semibold text-gray-500 mb-3">Foto Sekolah / Gedung</p>
                <div class="flex items-center justify-center h-48 bg-gray-50 rounded-lg p-2 border border-gray-100 overflow-hidden">
                    @php $foto = data_get($profil, 'foto_gedung') ?? data_get($profil, 'foto') ?? data_get($profil, 'gambar'); @endphp
                    @if ($foto && file_exists(public_path('storage/' . $foto)))
                        <img src="{{ asset('storage/' . $foto) }}" alt="Foto Gedung" class="w-full h-full object-cover rounded-md">
                    @else
                        <img src="{{ asset('storage/sd.jpg') }}" alt="Gedung Sekolah" class="w-full h-full object-cover rounded-md">
                    @endif
                </div>
            </div>

            {{-- <!-- Foto Kepala Sekolah -->
            <div class="text-center">
                <p class="text-sm font-semibold text-gray-500 mb-3">Foto Kepala Sekolah</p>
                <div class="flex items-center justify-center h-48 bg-gray-50 rounded-lg p-2 border border-gray-100 overflow-hidden">
                    @php $fotoKasek = data_get($profil, 'foto_kepala_sekolah'); @endphp
                    @if ($fotoKasek && file_exists(public_path('storage/' . $fotoKasek)))
                        <img src="{{ asset('storage/' . $fotoKasek) }}" alt="Kepala Sekolah" class="w-full h-full object-cover rounded-md">
                    @else
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <i class="fas fa-user-tie text-4xl mb-2"></i>
                            <span class="text-xs">Belum ada foto</span>
                        </div>
                    @endif
                </div>
            </div> --}}
        </div>

        <hr class="border-gray-100">

        <!-- Detail Identitas Sekolah -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-sm">
            <div class="space-y-2">
                <div class="flex justify-between py-1 border-b border-gray-50">
                    <span class="text-gray-500 w-1/3">Nama Sekolah</span>
                    <span class="text-gray-400 w-1/12 text-center">:</span>
                    <span class="font-semibold text-gray-800 w-7/12">{{ data_get($profil, 'nama_sekolah', 'SDN PASIRSALAM') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-50">
                    <span class="text-gray-500 w-1/3">Kepala Sekolah</span>
                    <span class="text-gray-400 w-1/12 text-center">:</span>
                    <span class="font-medium text-gray-800 w-7/12">{{ data_get($profil, 'nama_kepala_sekolah', '-') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-50">
                    <span class="text-gray-500 w-1/3">NPSN</span>
                    <span class="text-gray-400 w-1/12 text-center">:</span>
                    <span class="font-medium text-gray-800 w-7/12">{{ data_get($profil, 'npsn', '-') }}</span>
                </div>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between py-1 border-b border-gray-50">
                    <span class="text-gray-500 w-1/3">Tahun Berdiri</span>
                    <span class="text-gray-400 w-1/12 text-center">:</span>
                    <span class="font-medium text-gray-800 w-7/12">{{ data_get($profil, 'tahun_berdiri', '-') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-50">
                    <span class="text-gray-500 w-1/3">Kontak</span>
                    <span class="text-gray-400 w-1/12 text-center">:</span>
                    <span class="font-medium text-gray-800 w-7/12">{{ data_get($profil, 'no_telepon') ?? data_get($profil, 'telepon') ?? '-' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-gray-50">
                    <span class="text-gray-500 w-1/3">Alamat</span>
                    <span class="text-gray-400 w-1/12 text-center">:</span>
                    <span class="font-medium text-gray-800 w-7/12">{{ data_get($profil, 'alamat', '-') }}</span>
                </div>
            </div>
        </div>

        <hr class="border-gray-100">

        <!-- DESKRIPSI & VISI MISI -->
        <div class="space-y-6 pt-2">
            <!-- Deskripsi -->
            <div>
                <h3 class="text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-600"></i> Deskripsi Sekolah
                </h3>
                <div class="p-4 bg-gray-50 rounded-lg text-sm text-gray-600 leading-relaxed border border-gray-100">
                    {!! nl2br(e(data_get($profil, 'deskripsi') ?? data_get($profil, 'sejarah') ?? 'Deskripsi sekolah belum diisi.')) !!}
                </div>
            </div>

            <!-- Visi & Misi Menjadi Satu Kotak / Textarea Tunggal -->
            <div>
                <h3 class="text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-bullseye text-blue-600"></i> Visi & Misi Sekolah
                </h3>
                <div class="p-4 bg-gray-50 rounded-lg text-sm text-gray-600 leading-relaxed border border-gray-100">
                    {!! nl2br(e(data_get($profil, 'visi_misi') ?? data_get($profil, 'visi') ?? 'Visi & Misi sekolah belum diisi.')) !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
