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
        'gender',
        'deskripsi',
        'foto',
        'kondisi',
        'status',
    ];

    public function permintaans()
    {
        return $this->hasMany(Permintaan::class);
    }

    public function adopsis()
    {
        return $this->hasMany(Adopsi::class, 'hewan_id');
    }
}
