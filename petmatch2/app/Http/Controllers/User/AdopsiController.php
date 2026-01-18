<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Adopsi;
use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdopsiController extends Controller
{
    public function index()
    {
        $adopsis = Adopsi::where('user_id', Auth::id())
            ->latest()
            ->get();

        $hewans = Hewan::whereDoesntHave('adopsis')->get();

        return view('user.adopsi.index', compact('adopsis', 'hewans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => 'required|exists:hewan,id',
        ]);

        Adopsi::create([
            'user_id'  => Auth::id(),
            'hewan_id' => $request->hewan_id,
            'status'   => 'pending',
        ]);

        return back()->with('success', 'Permintaan adopsi berhasil dikirim!');
    }
}
