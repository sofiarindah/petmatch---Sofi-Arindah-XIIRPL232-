<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
protected $fillable = [
    'user_id',
    'hewan_id',
    'nama_lengkap',
    'no_hp',
    'pekerjaan',
    'alamat',
    'alasan',
    'status'
];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function hewan()
{
    return $this->belongsTo(Hewan::class);
}


}
