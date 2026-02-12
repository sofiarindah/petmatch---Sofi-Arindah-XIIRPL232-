<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    // ======================
    // LIST PERMINTAAN USER
    // ======================
    public function index()
    {
        return view('user.permintaan.index', [
            'hewans' => Hewan::all(),
            'permintaans' => Permintaan::where('user_id', Auth::id())
                ->latest()
                ->get()
        ]);
    }

    // ======================
    // SIMPAN PERMINTAAN
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => 'required|exists:hewan,id',
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
            'alasan' => 'required|string',
        ]);

        Permintaan::create([
            'user_id' => Auth::id(),
            'hewan_id' => $request->hewan_id,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'alasan' => $request->alasan,
            'catatan' => $request->alasan,
            'status' => 'diajukan'
        ]);

        return back()->with('success', 'Permintaan berhasil dikirim');
    }

    // ======================
    // NOTA ADOPSI (BUKTI)
    // ======================
    public function nota(Permintaan $permintaan)
    {
        // pastikan milik user yang login
        if ($permintaan->user_id !== auth()->id()) {
            abort(403);
        }

        // hanya bisa jika diterima admin
        if ($permintaan->status !== 'diterima') {
            abort(404);
        }

        return view('user.permintaan.nota', compact('permintaan'));
    }
}
