<?php

namespace App\Http\Controllers;

use App\Models\Lulusan;
use Illuminate\Http\Request;

class LulusanController extends Controller
{
    public function index()
    {
        $lulusans = Lulusan::orderBy('tahun_lulus', 'desc')->get();
        return view('siswa.lulusan', compact('lulusans'));
    }

    public function create()
    {
        return view('lulusan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:255',
            'angkatan'    => 'required|string|max:50',
            'tahun_lulus' => 'nullable|string|max:50',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('lulusan', 'public');
        }

        Lulusan::create($data);

        return redirect()->route('lulusan.index')
            ->with('success', 'Data lulusan berhasil ditambahkan');
    }

    public function edit(Lulusan $lulusan)
    {
        return view('lulusan.edit', compact('lulusan'));
    }

    public function update(Request $request, Lulusan $lulusan)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:255',
            'angkatan'    => 'required|string|max:50',
            'tahun_lulus' => 'nullable|string|max:50',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('lulusan', 'public');
        }

        $lulusan->update($data);

        return redirect()->route('lulusan.index')
            ->with('success', 'Data lulusan berhasil diperbarui');
    }

    public function destroy(Lulusan $lulusan)
    {
        $lulusan->delete();

        return redirect()->route('lulusan.index')
            ->with('success', 'Data lulusan berhasil dihapus');
    }
}
