<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $table = 'hewan';

    protected $fillable = [
        'nama',
        'jenis',
        'umur',
        'deskripsi',
        'foto',
        'kondisi',
        'status',
    ];
}
