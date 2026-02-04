<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Support\Facades\Auth;

class NotaAdopsiController extends Controller
{
    public function show($id)
    {
        $permintaan = Permintaan::with(['user', 'hewan'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'diterima')
            ->firstOrFail();

        return view('user.permintaan.nota', compact('permintaan'));
    }
}
