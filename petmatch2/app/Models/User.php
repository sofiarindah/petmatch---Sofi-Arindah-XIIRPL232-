<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database (opsional jika nama tabelnya 'users')
     */
    protected $table = 'users';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment)
     */
    protected $fillable = [
    'nama',      
    'name',
    'username',
    'email',
    'password',
    'role',
];

    /**
     * Kolom yang disembunyikan saat data dikonversi ke Array/JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi User ke Permintaan Adopsi (1 User bisa punya banyak permintaan)
     */
    public function permintaans()
    {
        return $this->hasMany(Permintaan::class, 'user_id');
    }

    /**
     * Relasi User ke Chat (1 User bisa punya banyak riwayat chat)
     */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }

    /**
     * Relasi User ke AdminProfile (Hanya jika role-nya admin)
     */
    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class, 'user_id');
    }
}