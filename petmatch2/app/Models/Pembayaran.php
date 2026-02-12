<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Response;

class Pembayaran extends Model
{
    protected $fillable = [
    'user_id',
    'permintaan_id',
    'kode_pembayaran',
    'jumlah',
    'metode_pembayaran',
    'bukti',
    'status',
];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }

    public function hewan()
{
    return $this->hasOneThrough(
        Hewan::class,
        Permintaan::class,
        'id',
        'id',
        'permintaan_id',
        'hewan_id'
    );
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
