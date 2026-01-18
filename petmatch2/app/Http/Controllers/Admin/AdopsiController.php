<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adopsi;

class AdopsiController extends Controller
{
    public function index()
    {
        $adopsis = Adopsi::with(['user','hewan'])
            ->latest()
            ->get();

        return view('admin.adopsi.index', compact('adopsis'));
    }

    public function approve(Adopsi $adopsi)
    {
        $adopsi->update(['status' => 'disetujui']);
        return back()->with('success', 'Adopsi disetujui');
    }

    public function reject(Adopsi $adopsi)
    {
        $adopsi->update(['status' => 'ditolak']);
        return back()->with('success', 'Adopsi ditolak');
    }
}
