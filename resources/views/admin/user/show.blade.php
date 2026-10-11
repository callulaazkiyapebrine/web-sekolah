@extends('admin_app')

@section('title', 'Detail User')
@section('breadcrumb', 'Detail User')

@section('content')
<div class="container-fluid px-4 py-3">

    <div class="mx-auto"
         style="
            max-width: 900px;
            background: #ffffff;
            border: 1px solid #dce5f0;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
         ">

        {{-- HEADER --}}
        <div style="border-bottom: 1px solid #edf2f7; padding-bottom: 16px; margin-bottom: 24px;">
            <h5 class="fw-bold mb-1" style="color: #172b4d;">
                Detail Data User
            </h5>

            <p class="small mb-0" style="color: #718096;">
                Informasi lengkap akun pengguna sistem.
            </p>
        </div>



        {{-- DETAIL INFORMASI --}}
        <div class="d-flex flex-column" style="gap: 8px;">

            {{-- NAMA --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap"
                 style="
                    background: #f7f9fc;
                    border: 1px solid #dce5f0;
                    border-radius: 8px;
                    padding: 12px;
                    gap: 8px;
                 ">
                <span class="small" style="color: #344563;">
                    Nama Pengguna
                </span>

                <strong class="small text-dark">
                    {{ $user->name ?? '-' }}
                </strong>
            </div>

            {{-- EMAIL --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap"
                 style="
                    background: #f7f9fc;
                    border: 1px solid #dce5f0;
                    border-radius: 8px;
                    padding: 12px;
                    gap: 8px;
                 ">
                <span class="small" style="color: #344563;">
                    Alamat Email
                </span>

                <strong class="small text-dark">
                    {{ $user->email ?? '-' }}
                </strong>
            </div>

            {{-- USERNAME --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap"
                 style="
                    background: #f7f9fc;
                    border: 1px solid #dce5f0;
                    border-radius: 8px;
                    padding: 12px;
                    gap: 8px;
                 ">
                <span class="small" style="color: #344563;">
                    Username
                </span>

                <strong class="small text-dark">
                    {{ $user->username ?? '-' }}
                </strong>
            </div>

            {{-- ROLE --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap"
                 style="
                    background: #f7f9fc;
                    border: 1px solid #dce5f0;
                    border-radius: 8px;
                    padding: 12px;
                    gap: 8px;
                 ">
                <span class="small" style="color: #344563;">
                    Role / Hak Akses
                </span>

                <strong class="small text-dark">
                    {{ $user->role ?? '-' }}
                </strong>
            </div>

            {{-- TANGGAL TERDAFTAR --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap"
                 style="
                    background: #f7f9fc;
                    border: 1px solid #dce5f0;
                    border-radius: 8px;
                    padding: 12px;
                    gap: 8px;
                 ">
                <span class="small" style="color: #344563;">
                    Tanggal Terdaftar
                </span>

                <strong class="small text-dark">
                    @if ($user->created_at)
                        {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y H:i') }}
                    @else
                        -
                    @endif
                </strong>
            </div>

        </div>

        {{-- TOMBOL BAWAH --}}
        <div class="d-flex justify-content-end align-items-center flex-wrap"
             style="gap: 8px; border-top: 1px solid #edf2f7; margin-top: 24px; padding-top: 16px;">

            <a href="{{ route('admin.user.index') }}"
               style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    background: #64748b;
                    color: #ffffff;
                    padding: 9px 16px;
                    border-radius: 9px;
                    text-decoration: none;
                    font-size: 12px;
                    font-weight: 600;
               ">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            <a href="{{ route('admin.user.addEdit', Crypt::encrypt($user->id)) }}"
               style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    background: #2860ed;
                    color: #ffffff;
                    padding: 9px 16px;
                    border-radius: 9px;
                    text-decoration: none;
                    font-size: 12px;
                    font-weight: 600;
               ">
                <i class="bi bi-pencil-square me-1"></i>
                Edit Data User
            </a>

        </div>

    </div>
</div>
@endsection
