<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
