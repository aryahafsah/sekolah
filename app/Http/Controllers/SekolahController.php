<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
public function profil()
{
    $school = (object)[
        'name'=>'SDN Joglo 05 Pagi',
        'npsn'=>'20105254',
        'address'=>'Joglo, Kembangan, Jakarta Barat',
        'akreditasi'=>'A',
        'telp'=>'(021) 5866651',
        'email'=>'info@sjn05.sch.id',
        'website'=>url('/'),
        'hero_image'=>'uploads/header.jpg',
        'about_html'=>'<p>Sejak tahun ...</p>'
    ];
    $stats = ['guru'=>18,'siswa'=>420,'rombel'=>14,'ruang'=>16];
    $gurus = \App\Models\Guru::all();
    $gallery = [
        'uploads/galeri/1.jpg','uploads/galeri/2.jpg','uploads/galeri/3.jpg'
    ];
    return view('sekolah.info', compact('school','stats','gurus','gallery'));
}
}