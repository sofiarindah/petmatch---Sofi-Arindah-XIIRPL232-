<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat'; // ← FIX di sini
    protected $fillable = [
        'user_id',
        'admin_id',
        'pesan',
        'waktu',
    ];

    // Relasi: pesan dikirim oleh user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: pesan diterima atau dibalas admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
