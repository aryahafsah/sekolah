<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KritikSaran;

class KritikSaranController extends Controller
{
   public function form()
{
    $kritikSaran = KritikSaran::latest()->get(); // ambil semua data terbaru
    return view('kritik.form', compact('kritikSaran'));
}
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'pesan' => 'required',
        ]);

        KritikSaran::create([
            'nama' => $request->nama,
            'pesan' => $request->pesan,
        ]);

        return back()->with('success', 'Terima kasih, kritik dan saran Anda sudah terkirim.');
    }
}
