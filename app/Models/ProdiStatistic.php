<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_mahasiswa',
        'jumlah_alumni',
        'jurnal_terpublikasi',
    ];
}
