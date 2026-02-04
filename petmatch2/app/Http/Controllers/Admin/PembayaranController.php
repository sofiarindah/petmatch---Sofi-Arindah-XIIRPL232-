<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('user')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    public function terima($id)
    {
        Pembayaran::findOrFail($id)->update([
            'status' => 'diterima'
        ]);

        return back()->with('success', 'Pembayaran diterima');
    }

    public function tolak($id)
    {
        Pembayaran::findOrFail($id)->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Pembayaran ditolak');
    }
    
}
