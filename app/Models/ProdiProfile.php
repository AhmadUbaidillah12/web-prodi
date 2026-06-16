<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'visi',
        'misi',
        'sejarah_singkat',
        'jadwal_file',
    ];
}
