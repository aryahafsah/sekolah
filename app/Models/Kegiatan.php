<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'foto'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
