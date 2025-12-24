<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /* ================= ADMIN ================= */

    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal','desc')->get();
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|mimes:jpg,jpeg,png,mp4,webm|max:20480'
        ]);

        $data = $request->only('judul','tanggal','deskripsi');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $nama);
            $data['foto'] = 'uploads/kegiatan/'.$nama;
        }

        Kegiatan::create($data);

        return redirect('/admin/kegiatan')->with('success','Kegiatan berhasil ditambahkan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
            'foto' => 'nullable|mimes:jpg,jpeg,png,mp4,webm|max:20480'
        ]);

        $data = $request->only('judul','tanggal','deskripsi');

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
                unlink(public_path($kegiatan->foto));
            }

            $file = $request->file('foto');
            $nama = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $nama);
            $data['foto'] = 'uploads/kegiatan/'.$nama;
        }

        $kegiatan->update($data);

        return redirect('/admin/kegiatan')->with('success','Kegiatan diperbarui');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->foto && file_exists(public_path($kegiatan->foto))) {
            unlink(public_path($kegiatan->foto));
        }

        $kegiatan->delete();
        return back()->with('success','Kegiatan dihapus');
    }

    /* ================= PUBLIC ================= */

    public function agenda()
    {
        $kegiatans = Kegiatan::orderBy('tanggal','desc')->paginate(9);
        return view('agenda.index', compact('kegiatans'));
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('agenda.show', compact('kegiatan'));
    }
}
