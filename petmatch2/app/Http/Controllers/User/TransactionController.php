<?php

// app/Http/Controllers/User/TransactionController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        return view('user.transaksi.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric'
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'kode_transaksi' => 'TRX-' . strtoupper(Str::random(8)),
            'total' => $request->total,
            'status' => 'diajukan'
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil dibuat');
    }

    public function struk($id)
    {
        Reservasi::updateStatusSelesai();

        $reservasi = Reservasi::with('user', 'studio', 'jadwal', 'pembayaran')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['dibayar', 'selesai'])
            ->findOrFail($id);

        return view('user.transaksi.struk', compact('reservasi'));
    }
}
