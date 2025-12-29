<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Hewan;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
{
    return view('admin.dashboard.index', [
        'total_hewan' => Hewan::count(),
        'total_pengadopsi' => User::count(),
        'pelanggan' => Pelanggan::with(['user', 'hewan'])->get(),
        'total_permintaan' => Pelanggan::count()
    ]);
}
}
