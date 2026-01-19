<?php

// app/Http/Controllers/Admin/TransactionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.transaksi.index', compact('transactions'));
    }

    public function terima($id)
    {
        Transaction::findOrFail($id)->update(['status' => 'diterima']);
        return back();
    }

    public function tolak($id)
    {
        Transaction::findOrFail($id)->update(['status' => 'ditolak']);
        return back();
    }

    public function nota($id)
{
    $transaction = Transaction::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('user.transaksi.nota', compact('transaction'));
}

}
