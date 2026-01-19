<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Http\Response;


class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'user_id',
        'kode_pembayaran',
        'jumlah',
        'bukti',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
