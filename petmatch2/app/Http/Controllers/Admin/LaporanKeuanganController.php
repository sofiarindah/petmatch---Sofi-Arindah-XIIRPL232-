<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with('user')
            ->where('status', 'diterima')
            ->orderBy('created_at', 'desc');

        // filter tanggal (opsional)
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [
                $request->from,
                $request->to
            ]);
        }

        // filter jenis (donasi/adopsi)
        if ($request->filled('jenis')) {
            if ($request->jenis === 'donasi') {
                $query->whereNull('permintaan_id');
            } elseif ($request->jenis === 'adopsi') {
                $query->whereNotNull('permintaan_id');
            }
        }

        $pembayarans = $query->get();

        $totalMasuk = $pembayarans->sum('jumlah');

        return view('admin.laporan-keuangan.index', compact(
            'pembayarans',
            'totalMasuk'
        ));
    }
}
