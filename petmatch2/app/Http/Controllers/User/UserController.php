<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Hewan; 
use App\Models\Category;

class UserController extends Controller
{
public function index(Request $request)
    {
        // 1. Ambil input search dan kategori dari URL
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // 2. Ambil semua kategori untuk filter
        $categories = Category::all();

        // 3. Query data hewan
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
            ->when($kategori, function ($query, $kategori) {
                // Filter berdasarkan jenis hewan (kategori)
                return $query->whereHas('category', function($q) use ($kategori) {
                    $q->where('nama', $kategori);
                });
            })
            ->latest()
            ->get();

        // 4. Kirim ke view
        return view('user.dashboard.index', compact('hewans', 'categories'));
    }

    public function hewan(Request $request)
    {
        // 1. Ambil input search dan kategori dari URL
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        // 2. Ambil semua kategori untuk filter
        $categories = Category::all();

        // 3. Query data hewan
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
            ->when($kategori, function ($query, $kategori) {
                // Filter berdasarkan relasi category
                return $query->whereHas('category', function($q) use ($kategori) {
                    $q->where('nama', $kategori);
                });
            })
            ->latest()
            ->get();

        // 4. Kirim ke view khusus list hewan
        return view('user.hewan.index', compact('hewans', 'categories'));
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
