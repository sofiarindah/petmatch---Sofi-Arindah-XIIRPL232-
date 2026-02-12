<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $table = 'hewan';

    protected $fillable = [
        'nama',
        'category_id',
        'jenis',
        'umur',
        'gender',
        'deskripsi',
        'foto',
        'kondisi',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function permintaans()
    {
        return $this->hasMany(Permintaan::class);
    }

    public function adopsis()
    {
        return $this->hasMany(Adopsi::class, 'hewan_id');
    }
}
