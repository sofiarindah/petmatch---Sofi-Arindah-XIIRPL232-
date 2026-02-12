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
use App\Http\Controllers\User\DetailController;
use App\Http\Controllers\User\ChatController as UserChatController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
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

Route::match(['get','post'],'/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('register');
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
        Route::get('/pembayaran', [\App\Http\Controllers\Admin\PembayaranController::class, 'index'])
            ->name('pembayaran.index');

        Route::get('/pembayaran/{id}', [\App\Http\Controllers\Admin\PembayaranController::class, 'show'])
            ->name('pembayaran.show');

        Route::post('/pembayaran/{id}/terima', [\App\Http\Controllers\Admin\PembayaranController::class, 'terima'])
            ->name('pembayaran.terima');

        Route::post('/pembayaran/{id}/tolak', [\App\Http\Controllers\Admin\PembayaranController::class, 'tolak'])
            ->name('pembayaran.tolak');

        //Riwayat
        Route::get('riwayat', [RiwayatController::class, 'index'])
            ->name('riwayat.index');

        //Laporan Keuangan
                Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])
                    ->name('laporan-keuangan');

        // Messages
        Route::get('/chat', [AdminChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/{id}', [AdminChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/{id}', [AdminChatController::class, 'store'])->name('chat.store');

    });

// ================= USER =================
Route::middleware('auth')->group(function () {

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');
    
    // List Semua Hewan
    Route::get('/user/hewan', [UserController::class, 'hewan'])
        ->name('user.hewan');

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
    Route::get('user-pembayaran/{pembayaran}/bukti-transfer',[UserPembayaran::class, 'buktiTransfer'])
        ->name('user-pembayaran.bukti-transfer');

    // Detail
    Route::get('/detail/{id}', [DetailController::class, 'index'])
        ->name('user.detail');

    // Chat
    Route::get('/chat', [UserChatController::class, 'index'])->name('user.chat.index');
    Route::post('/chat', [UserChatController::class, 'store'])->name('user.chat.store');


});
Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
});
