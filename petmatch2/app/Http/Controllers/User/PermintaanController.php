<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index()
    {
        return view('user.permintaan.index', [
            'hewans' => Hewan::all(),
            'permintaans' => Permintaan::where('user_id', Auth::id())->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => 'required',
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
        ]);

        Permintaan::create([
            'user_id' => Auth::id(),
            'hewan_id' => $request->hewan_id,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'status' => 'diajukan'
        ]);

        return back()->with('success','Permintaan berhasil dikirim');
    }
}
