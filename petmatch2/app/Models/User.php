<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * ============================
     *   🔥 RELASI USER
     * ============================
     */

    // 1. Relasi User -> AdminProfile (1 : 1)
    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class, 'user_id');
    }

    // 2. Relasi User -> Permintaan (1 : banyak)
    public function permintaan()
    {
        return $this->hasMany(\App\Models\Permintaan::class);
    }

    // 3. Relasi User -> Chat (1 : banyak)
    public function chat()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }
}
