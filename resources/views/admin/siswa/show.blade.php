@extends('admin_app')

@section('title', 'Detail Data Siswa')
@section('breadcrumb', 'Detail Siswa')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200 max-w-4xl mx-auto">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
        <div>
            <h5 class="font-bold text-slate-800 text-lg">Detail Data Siswa</h5>
            <p class="text-xs text-slate-500">Informasi lengkap profil siswa sekolah.</p>
        </div>
    </div>

    <!-- CARD PROFIL SIMPEL -->
    <div class="bg-blue-600 rounded-xl p-5 text-center text-white mb-6">
        <div class="w-20 h-20 rounded-full bg-white mx-auto mb-3 overflow-hidden border-2 border-white flex items-center justify-center">
            @if(isset($siswa->foto) && file_exists(public_path('storage/' . $siswa->foto)))
                <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" class="w-full h-full object-cover">
            @else
                <i class="fas fa-user-graduate text-4xl text-blue-600"></i>
            @endif
        </div>
        <h4 class="font-bold text-lg text-white mb-0">{{ $siswa->nama ?? $siswa->nama_siswa ?? '-' }}</h4>
        <p class="text-xs text-blue-100 mt-1">NISN: {{ $siswa->nisn ?? '-' }} &bull; Kelas: {{ $siswa->kelas ?? '-' }}</p>
    </div>

    <!-- DETAIL INFORMASI -->
    <div class="space-y-2">
        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
            <span class="text-xs font-medium text-slate-600">NISN</span>
            <span class="text-xs font-bold text-slate-800">{{ $siswa->nisn ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
            <span class="text-xs font-medium text-slate-600">Nama Lengkap</span>
            <span class="text-xs font-bold text-slate-800">{{ $siswa->nama ?? $siswa->nama_siswa ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
            <span class="text-xs font-medium text-slate-600">Kelas</span>
            <span class="text-xs font-bold text-slate-800">{{ $siswa->kelas ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
            <span class="text-xs font-medium text-slate-600">Jenis Kelamin</span>
            <span class="text-xs font-bold text-slate-800">{{ $siswa->jenis_kelamin ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
            <span class="text-xs font-medium text-slate-600">Tahun Masuk</span>
            <span class="text-xs font-bold text-slate-800">{{ $siswa->tahun_masuk ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-200">
            <span class="text-xs font-medium text-slate-600">Tanggal Terdaftar</span>
            <span class="text-xs font-bold text-slate-800">
                {{ \Carbon\Carbon::parse($siswa->created_at ?? now())->translatedFormat('d F Y H:i') }}
            </span>
        </div>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-slate-100">
        <a href="{{ route('admin.siswa.index') }}" class="px-4 py-2 bg-slate-500 hover:bg-slate-600 text-white text-xs font-medium rounded-lg transition-all">
            Kembali
        </a>
        @php
            $siswaId = $siswa->id_siswa ?? $siswa->id ?? '';
        @endphp
        <a href="{{ route('admin.siswa.addEdit', Crypt::encrypt($siswaId)) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all">
            Edit Data Siswa
        </a>
    </div>
</div>
@endsection