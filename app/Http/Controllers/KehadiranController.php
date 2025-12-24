<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kegiatan;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahGuru  = Guru::count();
        $kegiatanBulanIni = Kegiatan::whereMonth('tanggal', Carbon::now()->month)->count();

        return view('kehadiran.index', compact('jumlahSiswa', 'jumlahGuru', 'kegiatanBulanIni'));
    }
}
