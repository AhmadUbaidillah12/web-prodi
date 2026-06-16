<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenAkademik extends Model
{
    use HasFactory;

    protected $table = 'dokumen_akademik';

    protected $fillable = [
        'nama_dokumen',
        'file_path',
        'deskripsi',
    ];
}
