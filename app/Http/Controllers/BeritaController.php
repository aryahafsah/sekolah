<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib untuk manajemen file

class BeritaController extends Controller
{
    /**
     * READ: Menampilkan daftar semua berita.
     */
    public function index()
    {
        // Mengambil semua berita, diurutkan berdasarkan yang terbaru
        $beritas = Berita::latest()->get(); 
        
        // Mengarahkan ke view daftar berita
        return view('berita.index', compact('beritas'));
    }

    /**
     * CREATE: Menampilkan formulir untuk membuat berita baru.
     */
    public function create()
    {
        // Mengarahkan ke view form tambah berita
        return view('berita.create');
    }

    /**
     * STORE: Menyimpan artikel berita baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
            'tanggal' => 'nullable|date',
        ]);

        // 2. Penanganan Upload Foto
        if ($request->hasFile('foto')) {
            // Simpan file dan dapatkan path
            $path = $request->file('foto')->store('photos/berita', 'public');
            $validatedData['foto'] = $path; // Simpan path ke database
        }
        
        Berita::create($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    /**
     * SHOW: Menampilkan detail spesifik satu artikel berita.
     */
    public function show(Berita $beritum) // Menggunakan $beritum karena Laravel menghindari nama $berita
    {
        // Route Model Binding otomatis mengambil data berita
        return view('berita.show', compact('beritum'));
    }

    /**
     * EDIT: Menampilkan formulir untuk mengedit artikel berita.
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    /**
     * UPDATE: Memperbarui artikel berita yang sudah ada di database.
     */
    public function update(Request $request, Berita $berita)
    {
        // 1. Validasi
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'tanggal' => 'nullable|date',
        ]);

        // 2. Penanganan Upload Foto dan Penghapusan Foto Lama
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika path-nya ada
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            
            // Simpan foto baru
            $path = $request->file('foto')->store('photos/berita', 'public');
            $validatedData['foto'] = $path;
        }

        $berita->update($validatedData);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate');
    }

    /**
     * DESTROY: Menghapus artikel berita dari database.
     */
    public function destroy(Berita $berita)
    {
        // 1. Hapus Foto dari Storage sebelum menghapus record
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        
        // 2. Hapus Record Database
        $berita->delete();
        
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}