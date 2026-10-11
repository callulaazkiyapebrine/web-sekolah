<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest('tanggal')->get();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function addEdit($id = null)
    {
        try {
            $galeri = $id
                ? Galeri::findOrFail(Crypt::decrypt($id))
                : null;
        } catch (\Exception $e) {
            return redirect()->route('admin.galeri.index')->with('error', 'Data galeri tidak ditemukan!');
        }

        return view('admin.galeri.form', compact('galeri'));
    }

    public function save(Request $request, $id = null)
    {
        if ($id) {
            try {
                $id = Crypt::decrypt($id);
                $galeri = Galeri::findOrFail($id);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }
        } else {
            $galeri = new Galeri();
        }

        // Aturan validasi
        $rules = [
            'judul'      => 'required|string|max:50',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ];

        // Validasi bersyarat sesuai Kategori
        if ($request->kategori === 'Foto') {
            $rules['file'] = $id ? 'nullable|image|mimes:jpeg,png,jpg|max:5048' : 'required|image|mimes:jpeg,png,jpg|max:5048';
        } else {
            $rules['file'] = $id ? 'nullable|url' : 'required|url';
        }

        $request->validate($rules, [
            'judul.required'    => 'Judul galeri wajib diisi.',
            'judul.max'         => 'Judul maksimal 50 karakter.',
            'kategori.required' => 'Pilih kategori (Foto atau Video).',
            'tanggal.required'  => 'Tanggal wajib diisi.',
            'file.required'     => $request->kategori === 'Foto' ? 'File foto wajib diunggah.' : 'Link video YouTube wajib diisi.',
            'file.image'        => 'File yang diunggah harus berupa gambar.',
            'file.mimes'        => 'Format gambar yang didukung: JPG, PNG, JPEG.',
            'file.max'          => 'Ukuran gambar maksimal 5MB.',
            'file.url'          => 'Format link video harus berupa URL valid (contoh: https://www.youtube.com/watch?v=xxxxxx).',
        ]);

        $galeri->judul      = $request->judul;
        $galeri->kategori   = $request->kategori;
        $galeri->tanggal    = $request->tanggal;
        $galeri->keterangan = $request->keterangan;

        // Proses simpan data
        if ($request->kategori === 'Foto') {
            if ($request->hasFile('file')) {
                // Hapus berkas gambar lama jika sebelumnya berupa file
                if ($galeri->file && !filter_var($galeri->file, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($galeri->file)) {
                    Storage::disk('public')->delete($galeri->file);
                }
                $galeri->file = $request->file('file')->store('galeri', 'public');
            }
        } else {
            // Jika memilih kategori Video
            if ($request->filled('file')) {
                // Hapus berkas gambar lama jika sebelumnya merupakan Foto
                if ($galeri->file && !filter_var($galeri->file, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($galeri->file)) {
                    Storage::disk('public')->delete($galeri->file);
                }
                $galeri->file = $request->file;
            }
        }

        $galeri->save();

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                $id
                    ? 'Dokumentasi galeri berhasil diperbarui.'
                    : 'Dokumentasi galeri berhasil ditambahkan.'
            );
    }

    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt(str_replace(' ', '+', $id));
            $galeri = Galeri::where('id_galeri', $decryptedId)->firstOrFail();

            return view('admin.galeri.show', compact('galeri'));
        } catch (\Exception $e) {
            return redirect()->route('admin.galeri.index')->with('error', 'Data galeri tidak ditemukan!');
        }
    }

    public function destroy($id)
    {
        try {
            $galeri = Galeri::findOrFail(Crypt::decrypt($id));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        if ($galeri->file && !filter_var($galeri->file, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Dokumentasi galeri berhasil dihapus.');
    }
}
