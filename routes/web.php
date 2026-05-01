<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\DataProdiController;
use App\Http\Controllers\KompensasiController;
use App\Http\Controllers\PengajuanBandingController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


// Route untuk user belum login (guest)
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('login.proses');
        Route::post('/login', 'login')->name('login.proses');
    });
});

// Route untuk user yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
Route::group(['middleware' => ['level:1']], function () {
    // Route::get('/', [DashboardController::class, 'index'])->name('home');
});

Route::group(['middleware' => ['level:2']], function () {
    // Route::get('/', [DashboardController::class, 'index'])->name('home');
});

});


Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('dashboard');

Route::resource('/kompensasi', KompensasiController::class);
Route::resource('/data_prodi', DataProdiController::class);
Route::resource('/data_mhs', DataMahasiswaController::class);
Route::resource('/pengajuan_banding', PengajuanBandingController::class);

