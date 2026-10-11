@extends('admin_app')

@section('title', isset($user) ? 'Edit User' : 'Tambah User')

@section('content')
<div style="padding: 15px 20px;">
    <!-- Container Utama Putih Bersih Card -->
    <div style="background-color: #ffffff; border-radius: 16px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); max-width: 800px; margin: 0 auto;">

        {{-- HEADER FORM --}}
        <div style="margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid #e9ecef;">
            <h4 style="font-weight: 700; color: #212529; margin: 0 0 4px 0; font-size: 18px;">
                {{ isset($user) ? 'Edit Data User' : 'Tambah User Baru' }}
            </h4>
            <p style="color: #6c757d; font-size: 13px; margin: 0;">
                {{ isset($user) ? 'Perbarui informasi akun pengguna di bawah ini.' : 'Lengkapi formulir berikut untuk menambahkan pengguna baru.' }}
            </p>
        </div>

        {{-- FORM INPUT --}}
        <form action="{{ route('admin.user.save', isset($user) ? Crypt::encrypt($user->id) : null) }}" method="POST">
            @csrf

            <!-- Nama Lengkap -->
            <div style="margin-bottom: 16px;">
                <label for="name" style="display: block; font-weight: 600; font-size: 13px; color: #343a40; margin-bottom: 6px;">
                    Nama Pengguna <span style="color: #dc3545;">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $user->name ?? '') }}"
                       placeholder="Masukkan nama pengguna"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; outline: none; background-color: #f8f9fa;"
                       required>
                @error('name')
                    <div style="color: #dc3545; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div style="margin-bottom: 16px;">
                <label for="email" style="display: block; font-weight: 600; font-size: 13px; color: #343a40; margin-bottom: 6px;">
                    Alamat Email <span style="color: #dc3545;">*</span>
                </label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email', $user->email ?? '') }}"
                       placeholder="contoh@sekolah.sch.id"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; outline: none; background-color: #f8f9fa;"
                       required>
                @error('email')
                    <div style="color: #dc3545; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div style="margin-bottom: 16px;">
                <label for="username" style="display: block; font-weight: 600; font-size: 13px; color: #343a40; margin-bottom: 6px;">
                    Username
                </label>
                <input type="text"
                       id="username"
                       name="username"
                       value="{{ old('username', $user->username ?? '') }}"
                       placeholder="Masukkan username"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; outline: none; background-color: #f8f9fa;">
                @error('username')
                    <div style="color: #dc3545; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role / Hak Akses -->
            <div style="margin-bottom: 16px;">
                <label for="role" style="display: block; font-weight: 600; font-size: 13px; color: #343a40; margin-bottom: 6px;">
                    Role / Hak Akses <span style="color: #dc3545;">*</span>
                </label>
                <select id="role"
                        name="role"
                        style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; outline: none; background-color: #f8f9fa;"
                        required>
                    <option value="Admin" {{ old('role', strtolower($user->role ?? '')) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Operator" {{ old('role', strtolower($user->role ?? '')) == 'operator' ? 'selected' : '' }}>Operator</option>
                </select>
                @error('role')
                    <div style="color: #dc3545; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div style="margin-bottom: 24px;">
                <label for="password" style="display: block; font-weight: 600; font-size: 13px; color: #343a40; margin-bottom: 6px;">
                    Password @if(!isset($user)) <span style="color: #dc3545;">*</span> @endif
                </label>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Masukkan password minimal 6 karakter"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 14px; outline: none; background-color: #f8f9fa;"
                       {{ !isset($user) ? 'required' : '' }}>
                @if(isset($user))
                    <small style="color: #6c757d; font-size: 12px; display: block; margin-top: 4px;">Kosongkan jika tidak ingin mengubah password.</small>
                @endif
                @error('password')
                    <div style="color: #dc3545; font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- FOOTER AKSI TOMBOL -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e9ecef; padding-top: 16px;">
                <a href="{{ route('admin.user.index') }}"
                   style="display: inline-block; background-color: #6c757d; color: #ffffff; padding: 8px 20px; border-radius: 8px; font-weight: 600; font-size: 13px; text-decoration: none;">
                    Kembali
                </a>
                <button type="submit"
                        style="background-color: #0d6efd; color: #ffffff; padding: 8px 24px; border-radius: 8px; font-weight: 600; font-size: 13px; border: none; cursor: pointer; box-shadow: 0 2px 4px rgba(13,110,253,0.2);">
                    {{ isset($user) ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
