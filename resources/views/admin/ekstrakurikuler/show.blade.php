@extends('admin_app')

@section('title', 'Detail Ekstrakurikuler')
@section('breadcrumb', 'Detail Eskul')

@section('content')
<div class="bg-white rounded-2xl shadow-soft-xl p-6 border border-sky-100 max-w-4xl mx-auto">
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h5 class="font-bold text-sky-950 text-xl mb-1">Detail Ekstrakurikuler</h5>
            <p class="text-xs text-slate-400 mb-0">Informasi lengkap kegiatan ekstrakurikuler sekolah.</p>
        </div>
    </div>

    <!-- CARD BANNER -->
    <div class="bg-gradient-to-r from-sky-600 via-blue-700 to-sky-800 rounded-2xl p-6 text-center text-white mb-6 shadow-md border-b-4 border-amber-400">
        <div class="w-24 h-24 rounded-2xl bg-white mx-auto mb-3 overflow-hidden border-4 border-amber-400 shadow-md flex items-center justify-center">
            @php
                // Mendeteksi kolom gambar/logo secara fleksibel
                $gambarEskul = $ekstrakurikuler->gambar ?? $ekstrakurikuler->logo ?? null;
            @endphp

            @if($gambarEskul && file_exists(public_path('storage/' . $gambarEskul)))
                <img src="{{ asset('storage/' . $gambarEskul) }}" alt="Gambar Eskul" class="w-full h-full object-cover">
            @else
                <i class="fas fa-running text-5xl text-sky-600"></i>
            @endif
        </div>
        <h4 class="font-bold text-xl mb-1 text-white">{{ $ekstrakurikuler->nama_ekskul ?? $ekstrakurikuler->nama ?? '-' }}</h4>
        <p class="text-xs text-amber-300 mb-0 font-semibold tracking-wide">Pembina: {{ $ekstrakurikuler->pembina ?? '-' }}</p>
    </div>

    <!-- DETAIL INFORMASI -->
    <div class="space-y-3">
        <div class="flex justify-between items-center p-3.5 bg-sky-50/50 rounded-xl border border-sky-100">
            <span class="text-xs font-semibold text-slate-600">Nama Ekstrakurikuler</span>
            <span class="text-xs font-bold text-slate-800">{{ $ekstrakurikuler->nama_ekskul ?? $ekstrakurikuler->nama ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3.5 bg-sky-50/50 rounded-xl border border-sky-100">
            <span class="text-xs font-semibold text-slate-600">Nama Pembina</span>
            <span class="text-xs font-bold text-slate-800">{{ $ekstrakurikuler->pembina ?? '-' }}</span>
        </div>

        <div class="flex justify-between items-center p-3.5 bg-sky-50/50 rounded-xl border border-sky-100">
            <span class="text-xs font-semibold text-slate-600">Jadwal Latihan</span>
            <span class="text-xs font-bold text-sky-700">{{ $ekstrakurikuler->jadwal_latihan ?? $ekstrakurikuler->jadwal ?? '-' }}</span>
        </div>

        <div class="p-3.5 bg-sky-50/50 rounded-xl border border-sky-100">
            <span class="text-xs font-semibold text-slate-600 block mb-1">Deskripsi / Ringkasan</span>
            <p class="text-xs text-slate-700 leading-relaxed mb-0">{{ $ekstrakurikuler->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100">
        <a href="{{ route('admin.ekstrakurikuler.index') }}" class="px-5 py-2 bg-slate-400 hover:bg-slate-500 text-white text-xs font-semibold rounded-xl transition-all">
            Kembali
        </a>
        <a href="{{ route('admin.ekstrakurikuler.addEdit', Crypt::encrypt($ekstrakurikuler->getKey())) }}" class="px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-xl transition-all shadow-sm">
            Edit Eskul
        </a>
    </div>
</div>
@endsection
