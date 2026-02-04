<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats = Permintaan::with(['user', 'hewan'])
            ->whereIn('status', ['diterima', 'ditolak'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.riwayat.index', compact('riwayats'));
    }
}
