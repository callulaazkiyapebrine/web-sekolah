<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas; // <-- Penting: Impor Model Kelas agar terbaca
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    /**
     * Menampilkan semua data siswa.
     */
    public function index()
    {
        $siswa = Siswa::latest()->get();

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Menampilkan form tambah atau ubah siswa.
     */
    public function addEdit($id = null)
    {
        $siswa = $id ? Siswa::findOrFail($id) : new Siswa();
        
        // Mengambil seluruh data dari tabel kelas master untuk dropdown
        $daftarKelas = Kelas::all();

        return view('admin.siswa.form', compact('siswa', 'daftarKelas'));
    }

    /**
     * Menampilkan detail siswa.
     */
    public function show($id)
    {
        try {
            $resolvedId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            $resolvedId = $id;
        }

        $siswa = Siswa::where('id', $resolvedId)->first();

        if (!$siswa) {
            return redirect()->route('admin.siswa.index')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Menghapus data siswa.
     */
    public function destroy($id)
    {
        try {
            $resolvedId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            $resolvedId = $id;
        }

        $siswa = Siswa::where('id', $resolvedId)->first();

        if (!$siswa) {
            return redirect()->route('admin.siswa.index')->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Menyimpan data baru atau mengubah data siswa.
     */
    public function save(Request $request, $id = null)
    {
        // Validasi input form
        $request->validate([
            'nisn' => 'required|string',
            'nama_siswa' => 'required|string',
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tahun_masuk' => 'required|numeric',
        ]);

        // 1. OTOMATIS TAMBAH KE TABEL KELAS JIKA BELUM ADA
        Kelas::firstOrCreate([
            'nama_kelas' => $request->kelas
        ]);

        // 2. PROSES SIMPAN ATAU UPDATE DATA SISWA
        if ($id) {
            try {
                $resolvedId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                $resolvedId = $id;
            }

            $siswa = Siswa::findOrFail($resolvedId);

            $siswa->update([
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
            ]);
        } else {
            Siswa::create([
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
            ]);
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa dan kelas berhasil disimpan!');
    }
}