<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KurikulumItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'kode_mk',
        'nama_mk',
        'sks',
        'jenis',
        'deskripsi',
    ];
}
