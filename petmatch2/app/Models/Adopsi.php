<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    protected $table = 'adopsis';

    protected $fillable = [
        'user_id',
        'hewan_id',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }
}
