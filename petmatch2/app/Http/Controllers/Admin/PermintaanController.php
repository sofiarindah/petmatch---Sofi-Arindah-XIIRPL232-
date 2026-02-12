<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::with(['user', 'hewan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.permintaan.index', compact('permintaans'));
    }

    public function terima(Request $request, $id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update([
            'status' => 'diterima',
            'catatan' => $request->input('catatan') // optional
        ]);

        return back()->with('success', 'Permintaan diterima');
    }

    public function tolak(Request $request, $id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update([
            'status' => 'ditolak',
            'catatan' => $request->input('catatan') // optional
        ]);

        return back()->with('success', 'Permintaan ditolak');
    }
}
