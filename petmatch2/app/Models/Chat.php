<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'user_id',
        'admin_id',
        'chat',
        'status_read',
    ];

    protected $casts = [
        'status_read' => 'boolean',
    ];

    // Pesan dikirim oleh user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Pesan diterima / dibalas admin
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
