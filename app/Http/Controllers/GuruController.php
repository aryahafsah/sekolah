<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GuruController extends Controller
{
    // ==============================
    // ADMIN - CRUD
    // ==============================
    public function index()
    {
        $gurus = Guru::orderBy('nama')->get();
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required',
            'jk'        => 'required|in:L,P',
            'foto_guru' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto_guru')) {

            $filename = time() . '_' . $request->foto_guru->getClientOriginalName();

            $request->foto_guru->move(
                public_path('uploads/foto_guru'),
                $filename
            );

            // SIMPAN PATH LENGKAP
            $data['foto_guru'] = 'uploads/foto_guru/' . $filename;
        }

        Guru::create($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama'      => 'required',
            'jk'        => 'required|in:L,P',
            'foto_guru' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_guru')) {

            // Hapus foto lama
            if ($guru->foto_guru && File::exists(public_path($guru->foto_guru))) {
                File::delete(public_path($guru->foto_guru));
            }

            $filename = time() . '_' . $request->foto_guru->getClientOriginalName();

            $request->foto_guru->move(
                public_path('uploads/foto_guru'),
                $filename
            );

            // SIMPAN PATH LENGKAP
            $data['foto_guru'] = 'uploads/foto_guru/' . $filename;
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil diupdate');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto_guru && File::exists(public_path($guru->foto_guru))) {
            File::delete(public_path($guru->foto_guru));
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Guru berhasil dihapus');
    }

    // ==============================
    // PUBLIC LIST
    // ==============================
    public function daftar()
    {
        $gurus = Guru::orderBy('nama')->get();
        return view('guru.daftar', compact('gurus'));
    }
}
