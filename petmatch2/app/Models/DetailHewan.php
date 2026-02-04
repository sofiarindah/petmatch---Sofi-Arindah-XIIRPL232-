<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class DetailHewan extends Model
{
    use HasFactory;

    protected $table = 'detail_hewan';

    protected $fillable = [
        'nama',
        'jenis',
        'umur',
        'deskripsi',
        'foto',
        'kondisi',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail(Pembayaran $pembayaran)
{
    $pembayaran->load(['hewan', 'user']);

    return view('user.pembayaran.detail', compact('pembayaran'));
}

}
