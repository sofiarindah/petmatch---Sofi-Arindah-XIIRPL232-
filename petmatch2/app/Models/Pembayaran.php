<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'permintaan_id',
        'total',
        'metode',
        'status',
    ];

    // Relasi: pembayaran milik permintaan
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }
}
