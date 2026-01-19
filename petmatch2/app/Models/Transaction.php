<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'kode_transaksi',
        'total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
