@extends('admin_app')

@section('title', 'Detail Data Guru')
@section('breadcrumb', 'Detail Guru')

@section('content')
<div class="bg-white rounded-2xl shadow-soft-xl p-6 border border-sky-100 max-w-4xl mx-auto">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h5 class="font-bold text-sky-950 text-xl mb-1">Detail Data Guru</h5>
            <p class="text-xs text-slate-400 mb-0">Informasi lengkap profil guru sekolah.</p>
        </div>
        {{-- <a href="{{ route('admin.guru.index') }}" class="bg-slate-500 hover:bg-slate-600 text-white text-xs px-4 py-2 rounded-xl transition-all">
            &larr; Kembali
        </a> --}}
    </div>

    <!-- CARD PROFIL (HEADER WARNA BIRU) -->
    <div class="bg-gradient-to-r from-sky-600 to-blue-700 rounded-2xl p-6 text-center text-white mb-6 shadow-md">
        <div class="w-24 h-24 rounded-full bg-white mx-auto mb-3 overflow-hidden border-4 border-white/30 shadow-inner flex items-center justify-center">
            @if(isset($guru->foto) && file_exists(public_path('storage/' . $guru->foto)))
                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="w-full h-full object-cover">
            @else
                <i class="fas fa-user-circle text-6xl text-slate-300"></i>
            @endif
        </div>
        <h4 class="font-bold text-xl mb-1">{{ $guru->nama ?? $guru->nama_guru ?? '-' }}</h4>
        <p class="text-xs text-sky-100 mb-0 font-medium">NIP: {{ $guru->nip ?? '-' }}</p>
    </div>

    <!-- DETAIL INFORMASI -->
    <div class="space-y-3">
        <div class="flex justify-between items-center p-3.5 bg-slate-50/80 rounded-xl border border-slate-100">
            <span class="text-xs font-semibold text-slate-600">NIP</span>
            <span class="text-xs font-bold text-slate-800">{{ $guru->nip ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3.5 bg-slate-50/80 rounded-xl border border-slate-100">
            <span class="text-xs font-semibold text-slate-600">Mata Pelajaran</span>
            <span class="text-xs font-bold text-slate-800">{{ $guru->mapel ?? $guru->mata_pelajaran ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3.5 bg-slate-50/80 rounded-xl border border-slate-100">
            <span class="text-xs font-semibold text-slate-600">Nama Lengkap</span>
            <span class="text-xs font-bold text-slate-800">{{ $guru->nama ?? $guru->nama_guru ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3.5 bg-slate-50/80 rounded-xl border border-slate-100">
            <span class="text-xs font-semibold text-slate-600">Tanggal Terdaftar</span>
            <span class="text-xs font-bold text-slate-800">
                {{ \Carbon\Carbon::parse($guru->created_at ?? now())->translatedFormat('d F Y H:i') }}
            </span>
        </div>
    </div>

    <!-- TOMBOL AKSI BOTTOM -->
    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100">
        <a href="{{ route('admin.guru.index') }}" class="px-5 py-2 bg-slate-400 hover:bg-slate-500 text-white text-xs font-semibold rounded-xl transition-all">
            Kembali
        </a>
        <a href="{{ route('admin.guru.addEdit', $guru->id ?? '') }}" class="px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-xl transition-all shadow-sm">
            Edit Data Guru
        </a>
    </div>
</div>
@endsection
