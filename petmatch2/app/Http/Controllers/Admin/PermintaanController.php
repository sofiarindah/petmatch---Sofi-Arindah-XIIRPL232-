<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::with(['user', 'hewan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.permintaan.index', compact('permintaans'));
    }

    public function terima($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update(['status' => 'diterima']);

        return back()->with('success', 'Permintaan diterima');
    }

    public function tolak($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update(['status' => 'ditolak']);

        return back()->with('success', 'Permintaan ditolak');
    }
}
