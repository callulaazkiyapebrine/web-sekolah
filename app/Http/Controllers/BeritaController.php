<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('user')->latest()->get();

        return view('admin.berita.index', compact('berita'));
    }

    public function addEdit($id = null)
    {
        if ($id === null) {
            $berita = new Berita;

            return view('admin.berita.form', compact('berita'));
        }

        $berita = Berita::find($id);

        if (! $berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin.berita.form', compact('berita'));
    }

    public function save(Request $request, $id = null)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($id !== null) {
            $berita = Berita::find($id);

            if (! $berita) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }
        } else {
            $berita = new Berita;
        }

        $berita->judul = $validated['judul'];
        $berita->isi = $validated['isi'];
        $berita->tanggal = $validated['tanggal'] ?? null;

        if ($request->hasFile('gambar')) {
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $berita->gambar = $request->file('gambar')
                ->store('berita', 'public');
        }

        $berita->save();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Data berita berhasil disimpan.');
    }

    public function show($id)
    {
        $berita = Berita::with('user')
            ->where('id_berita', $id)
            ->first();

        if (! $berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin.berita.show', compact('berita'));
    }

    public function destroy($id)
    {
        $berita = Berita::find($id);

        if (! $berita) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Data berita berhasil dihapus.');
    }
}
