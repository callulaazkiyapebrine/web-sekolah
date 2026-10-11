<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
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
        $siswa = null;

        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $siswa = Siswa::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }
        }

        return view('admin.siswa.form', compact('siswa'));
    }

    /**
     * Menyimpan data baru atau mengubah data siswa.
     */
    public function save(Request $request, $id = null)
    {
        // 1. Validasi Input
        $request->validate([
            'nisn' => 'required',
            'nama_siswa' => 'required',
            'kelas' => 'required', // <-- Tambahkan baris ini
            'jenis_kelamin' => 'required',
            'tahun_masuk' => 'required',
        ]);

        // 2. Dekripsi ID jika sedang Edit Data
        $siswaId = $id ? Crypt::decrypt($id) : null;

        // 3. Simpan / Update ke Database
        Siswa::updateOrCreate(
            ['id' => $siswaId],
            [
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'kelas' => $request->kelas, // <-- PASTIKAN BARIS INI ADA!
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
            ]
        );

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil disimpan!');
    }

    /**
     * Menampilkan detail siswa.
     */
    public function show($id)
    {
        try {
            $siswa = Siswa::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('admin.siswa.show', compact('siswa'));
    }

    /**
     * Menghapus data siswa.
     */
    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
