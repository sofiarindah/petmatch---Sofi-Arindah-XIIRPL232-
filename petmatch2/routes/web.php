<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\HewanController;
use App\Http\Controllers\Admin\PermintaanController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// ================= TAMBAHAN (AMAN) =================

// tampilkan form login admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])
    ->name('admin.login');

// proses login admin
Route::post('/admin/login', [LoginController::class, 'login'])
    ->name('admin.login.process');

// logout admin
Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->name('admin.logout');

// ================= SCRIPT ASLI KAMU (TIDAK DIUBAH) =================

// Grup route admin
Route::prefix('admin')->name('admin.')->group(function () {

    // LOGIN (ASLI)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');

    // CRUD Hewan
    Route::resource('hewan', \App\Http\Controllers\Admin\HewanController::class);

    // Permintaan Adopsi
    Route::resource('/permintaan', PermintaanController::class);

    // Setujui / tolak permintaan
    Route::post('/permintaan/{id}/setuju', [PermintaanController::class, 'setuju'])->name('permintaan.setuju');
    Route::post('/permintaan/{id}/tolak', [PermintaanController::class, 'tolak'])->name('permintaan.tolak');
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard.index');
    })->name('dashboard');
});
