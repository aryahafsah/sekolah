<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /* ================= ADMIN ================= */

    public function index()
    {
        $galeris = Galeri::orderBy('judul', 'asc')->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'judul'          => 'required|string|max:255',
        'berita singkat' => 'nullable|string',
        'isi berita'     => 'nullable|string',
        'foto'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload foto
    $file = $request->file('foto');
    $namaFile = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/galeri'), $namaFile);

    // INI YANG PENTING: ambil pake nama yang ada spasi
    Galeri::create([
        'judul'          => $request->judul,
        'berita singkat' => $request->input('berita singkat'),  // pake spasi
        'isi berita'     => $request->input('isi berita'),      // pake spasi
        'foto'           => $namaFile,
    ]);

    return redirect()
        ->route('admin.galeri.index')
        ->with('success', 'Galeri berhasil ditambahkan');
}
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        // Validation sama kayak store, tapi foto nullable
        $data = $request->validate([
            'judul'          => 'required|string|max:255',
            'berita singkat' => 'nullable|string',
            'isi berita'     => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada foto baru, hapus yang lama & upload baru
        if ($request->hasFile('foto')) {
            $pathLama = public_path('uploads/galeri/' . $galeri->foto);
            if ($galeri->foto && file_exists($pathLama)) {
                unlink($pathLama);
            }

            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $namaFile);

            $data['foto'] = $namaFile;
        }

        // Update pake spasi di key kolom
        $galeri->update([
            'judul'          => $data['judul'],
            'berita singkat' => $data['berita singkat'] ?? $galeri->{'berita singkat'},
            'isi berita'     => $data['isi berita'] ?? $galeri->{'isi berita'},
            'foto'           => $data['foto'] ?? $galeri->foto,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        $path = public_path('uploads/galeri/' . $galeri->foto);
        if ($galeri->foto && file_exists($path)) {
            unlink($path);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus');
    }

    /* ================= PUBLIC ================= */

    public function indexPublic()
    {
        $galeris = Galeri::orderBy('judul', 'asc')->paginate(12);
        return view('galeri.index', compact('galeris'));
    }

    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }
}