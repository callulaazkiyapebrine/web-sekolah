<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileSekolah;
use Illuminate\Support\Facades\Storage;

class ProfileSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfileSekolah::first();
        return view('admin.profile-sekolah.index', compact('profil'));
    }

    public function save(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_sekolah'        => 'required|string|max:255',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'npsn'                => 'required|string|max:50',
            'tahun_berdiri'       => 'required|numeric',
            'no_telepon'          => 'required|string|max:20',
            'alamat'              => 'required|string',
            'visi_misi'           => 'required|string',
            'deskripsi'           => 'nullable|string',
            'logo'                => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_gedung'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil data pertama atau buat instance baru jika belum ada
        $profil = ProfileSekolah::first() ?? new ProfileSekolah();

        // 3. Set Data Text
        $profil->nama_sekolah        = $request->nama_sekolah;
        $profil->nama_kepala_sekolah = $request->nama_kepala_sekolah;
        $profil->npsn                = $request->npsn;
        $profil->tahun_berdiri       = $request->tahun_berdiri;
        $profil->no_telepon          = $request->no_telepon;
        $profil->alamat              = $request->alamat;
        $profil->visi_misi           = $request->visi_misi;
        $profil->deskripsi           = $request->deskripsi;

        // 4. Handle Upload Logo
        if ($request->hasFile('logo')) {
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $profil->logo = $request->file('logo')->store('profil', 'public');
        }

        // 5. Handle Upload Foto Gedung
        if ($request->hasFile('foto_gedung')) {
            if ($profil->foto_gedung && Storage::disk('public')->exists($profil->foto_gedung)) {
                Storage::disk('public')->delete($profil->foto_gedung);
            }
            $profil->foto_gedung = $request->file('foto_gedung')->store('profil', 'public');
        }

        // 6. Simpan ke Database
        $profil->save();

        return redirect()->back()->with('success', 'Profil Sekolah berhasil disimpan!');
    }
}
