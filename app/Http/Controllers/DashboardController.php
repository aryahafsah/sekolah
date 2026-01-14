<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index(Request $request)
{
    $bulan = $request->bulan ?? 1;
    $tahun = $request->tahun ?? 2026;
    $guru = $request->guru;

    // List guru
    $listGuru = DB::table('absensi_guru')
        ->select('nama_guru')
        ->groupBy('nama_guru')
        ->pluck('nama_guru');

    // Query dasar
    $query = DB::table('absensi_guru')
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun);

    if ($guru) {
        $query->where('nama_guru', $guru);
    }

    // Data untuk chart => Pake query yg sama
    $kehadiranPerGuru = $query->clone()
        ->select(
            'nama_guru',
            DB::raw('COUNT(*) as total_hari'),
            DB::raw('SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as hadir'),
            DB::raw('ROUND((SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) as persen_hadir')
        )
        ->groupBy('nama_guru')
        ->orderBy('persen_hadir', 'desc')
        ->get();

    // Proporsi status
    $proporsiStatus = $query->clone()
        ->select(
            'status',
            DB::raw('COUNT(*) as jumlah')
        )
        ->groupBy('status')
        ->get();

    // Tren harian
    $trenBulanan = $query->clone()
        ->select(
            DB::raw('DAY(tanggal) as tanggal_hari'),
            DB::raw('SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as hadir_harian')
        )
        ->groupBy('tanggal_hari')
        ->orderBy('tanggal_hari')
        ->get();

    // KPI
    $rataHadir = $kehadiranPerGuru->avg('persen_hadir') ?? 0;
    $guruTerbaik = $kehadiranPerGuru->first() ?? (object)['nama_guru' => 'N/A'];
    $guruTerendah = $kehadiranPerGuru->sortBy('persen_hadir')->first() ?? (object)['nama_guru' => 'N/A'];

    return view('dashboard.bi', compact(
        'kehadiranPerGuru',
        'proporsiStatus',
        'trenBulanan',
        'rataHadir',
        'guruTerbaik',
        'guruTerendah',
        'listGuru'
    ));
}

}
