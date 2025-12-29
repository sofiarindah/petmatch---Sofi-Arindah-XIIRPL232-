<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaan = Permintaan::with(['user', 'hewan'])
            ->latest()
            ->get();

        return view('admin.permintaan.index', compact('permintaan'));
    }

    public function show($id)
    {
        $permintaan = Permintaan::with(['user', 'hewan'])->findOrFail($id);
        return view('admin.permintaan.show', compact('permintaan'));
    }

    public function setuju($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update(['status' => 'diterima']);

        logActivity(
            "Menyetujui Permintaan",
            "Permintaan ID: $id | Hewan: " . $permintaan->hewan->nama
        );

        return redirect()
            ->route('admin.permintaan.index')
            ->with('success', 'Permintaan berhasil disetujui');
    }

    public function tolak($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update(['status' => 'ditolak']);

        logActivity(
            "Menolak Permintaan",
            "Permintaan ID: $id | Hewan: " . $permintaan->hewan->nama
        );

        return redirect()
            ->route('admin.permintaan.index')
            ->with('success', 'Permintaan berhasil ditolak');
    }
}
