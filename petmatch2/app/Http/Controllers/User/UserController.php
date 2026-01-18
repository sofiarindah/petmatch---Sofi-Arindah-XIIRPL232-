<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Hewan; 

class UserController extends Controller
{
public function index(Request $request)
{
    // 1. Ambil input search dari URL
    $search = $request->input('search');

    // 2. Query data hewan
    $hewans = Hewan::query()
        ->where('status', 'tersedia') // Pastikan hanya yang tersedia
        ->when($search, function ($query, $search) {
            // Logika pencarian: mencari berdasarkan nama atau jenis
            return $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('jenis', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

    // 3. Kirim ke view
    return view('user.dashboard.index', compact('hewans'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
