<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hewan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $hewans = Hewan::when($search, function ($query, $search) {
        $query->where('nama', 'like', "%{$search}%")
              ->orWhere('jenis', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
    })->get();

    return view('user.dashboard.index', compact('hewans'));
}
}
