<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\HewanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermintaanController as AdminPermintaanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PermintaanController as UserPermintaan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaran;
use App\Http\Controllers\Messages\MessageController;
use App\Http\Controllers\User\DetailController;
use App\Http\Controllers\User\PembayaranController as UserPembayaran;
use App\Http\Controllers\Admin\RiwayatController;
use App\Http\Controllers\Admin\LaporanKeuanganController;


// ================= REDIRECT =================
Route::get('/', function () {
    return redirect()->route('register');
});

// REGISTER
Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

// ================= LOGIN =================
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

// proses login
Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

// logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('register'); 
})->name('logout');

// ================= ADMIN =================
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Hewan
        Route::resource('hewan', HewanController::class);

        // Categories
        Route::resource('categories', CategoryController::class);

        // Permintaan
        Route::get('/permintaan', [AdminPermintaanController::class, 'index'])
            ->name('permintaan.index');

        Route::post('/permintaan/{id}/terima', [AdminPermintaanController::class, 'terima'])
            ->name('permintaan.terima');

        Route::post('/permintaan/{id}/tolak', [AdminPermintaanController::class, 'tolak'])
            ->name('permintaan.tolak');

        // Pembayaran 
        Route::get('/pembayaran', [AdminPembayaran::class, 'index'])
            ->name('pembayaran.index');

        Route::get('/pembayaran/{id}', [AdminPembayaran::class, 'show'])
            ->name('pembayaran.show');

        Route::post('/pembayaran/{id}/terima', [AdminPembayaran::class, 'terima'])
            ->name('pembayaran.terima');

        Route::post('/pembayaran/{id}/tolak', [AdminPembayaran::class, 'tolak'])
            ->name('pembayaran.tolak');

        //Riwayat
        Route::get('riwayat', [RiwayatController::class, 'index'])
            ->name('riwayat.index');

        //Laporan Keuangan
                Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])
                    ->name('laporan-keuangan');

    });

// ================= USER =================
Route::middleware('auth')->group(function () {

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');

    // Permintaan USER
    Route::prefix('permintaan')->name('user.permintaan.')->group(function () {
    Route::get('/', [UserPermintaan::class, 'index'])
        ->name('index');

    Route::post('/', [UserPermintaan::class, 'store'])
        ->name('store');

    Route::get('{permintaan}/nota', [UserPermintaan::class, 'nota'])
        ->name('nota');
        
    });

    // Pembayaran 
    Route::get('user-pembayaran', [UserPembayaran::class, 'index'])
        ->name('user-pembayaran.index'); 
    Route::get('user-pembayaran/create', [UserPembayaran::class, 'create'])
        ->name('user-pembayaran.create'); 
    Route::post('pembayaran', [UserPembayaran::class, 'store'])
        ->name('user-pembayaran.store'); 
    Route::put('user-pembayaran/{pembayaran}', [UserPembayaran::class, 'update'])
        ->name('user-pembayaran.update');
    Route::delete('user-pembayaran/{pembayaran}', [UserPembayaran::class, 'destroy'])
        ->name('user-pembayaran.destroy');
    Route::get('/user-pembayaran/{pembayaran}/nota', [UserPembayaran::class, 'nota'])
    ->name('user-pembayaran.nota');
    Route::get('user-pembayaran/{pembayaran}/detail',[UserPembayaran::class, 'detail'])
        ->name('user-pembayaran.detail');

    // Detail
    Route::get('/detail/{id}', [DetailController::class, 'index'])
        ->name('user.detail');


});
