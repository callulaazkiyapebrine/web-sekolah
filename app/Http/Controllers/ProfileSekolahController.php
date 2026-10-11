<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
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
            'nama_sekolah' => 'required|string|max:255',
            'nama_kepala_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string|max:50',
            'tahun_berdiri' => 'required|numeric',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'visi_misi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_gedung' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil data pertama
        $profil = ProfileSekolah::first();

        $data = [
            'nama_sekolah' => $request->nama_sekolah,
            'nama_kepala_sekolah' => $request->nama_kepala_sekolah,
            'npsn' => $request->npsn,
            'tahun_berdiri' => $request->tahun_berdiri,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'visi_misi' => $request->visi_misi,
            'deskripsi' => $request->deskripsi,
        ];

        // 3. Handle Upload Logo
        if ($request->hasFile('logo')) {
            if ($profil && $profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('profil', 'public');
        }

        // 4. Handle Upload Foto Gedung
        if ($request->hasFile('foto_gedung')) {
            if ($profil && $profil->foto_gedung && Storage::disk('public')->exists($profil->foto_gedung)) {
                Storage::disk('public')->delete($profil->foto_gedung);
            }
            $data['foto_gedung'] = $request->file('foto_gedung')->store('profil', 'public');
        }

        // 5. Update atau Buat Baris Baru tanpa tergantung Primary Key ID
        if ($profil) {
            ProfileSekolah::where('npsn', $profil->npsn)->orWhereRaw('1=1')->limit(1)->update($data);
        } else {
            ProfileSekolah::create($data);
        }

        return redirect()->route('admin.profile-sekolah.index')->with('success', 'Profil Sekolah berhasil disimpan!');
    }

    public function edit()
    {
        // Mengambil data profil sekolah pertama
        $profil = ProfileSekolah::first();

        // Mengarahkan ke file view edit (resources/views/admin/profile-sekolah/edit.blade.php)
        return view('admin.profile-sekolah.edit', compact('profil'));
    }
}
