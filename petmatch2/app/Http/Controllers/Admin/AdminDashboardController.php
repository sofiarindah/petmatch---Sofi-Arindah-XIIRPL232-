<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Permintaan;
use App\Models\Hewan;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalHewan'      => Hewan::count(),
            'totalPermintaan' => Permintaan::count(),
        ]);
    }
}
