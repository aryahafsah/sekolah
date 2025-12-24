<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kegiatan;
use App\Models\Galeri;


class LandingController extends Controller
{
    public function landing()
    {
        return view('landing', [
            'jumlahSiswa' => Siswa::count(),
            'jumlahGuru'  => Guru::count(),

            // JUMLAH (opsional kalau mau dipakai)
            'kegiatanBulanIni' => Kegiatan::whereMonth('tanggal', now()->month)->count(),

            // DATA KEGIATAN (INI YANG WAJIB)
            'kegiatans' => Kegiatan::orderBy('tanggal', 'desc')->get(),
            'galeris' => Galeri::orderBy('judul', 'desc', 'foto',)->take(8)->get(),
        ]);
    }
}
