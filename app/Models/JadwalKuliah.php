<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kuliah';

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'nama_mk',
        'dosen',
        'ruangan',
    ];
}
