@extends('admin_app')

@section('title', 'Detail Berita')
@section('breadcrumb', 'Detail Berita')

@section('content')
<div class="bg-white rounded-2xl shadow-soft-xl p-6 border border-sky-100 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6 border-b border-slate-100 pb-4">
        <div>
            <h5 class="font-bold text-sky-950 text-xl mb-1">{{ $berita->judul }}</h5>
            <div class="flex items-center gap-4 text-xs text-slate-400">
                <span><i class="far fa-calendar-alt text-sky-500 mr-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal ?? $berita->created_at)->translatedFormat('d F Y') }}</span>
                <span><i class="far fa-user text-sky-500 mr-1"></i> {{ $berita->user->name ?? 'Admin' }}</span>
            </div>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-semibold transition-all">
            Kembali
        </a>
    </div>

    @if($berita->gambar)
        <div class="mb-6 text-center">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="max-h-96 rounded-2xl object-cover mx-auto border border-slate-100 shadow-sm">
        </div>
    @endif

    <div class="prose max-w-none text-slate-700 text-sm leading-relaxed whitespace-pre-line">
        {!! nl2br(e($berita->isi)) !!}
    </div>
</div>
@endsection
