<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Grup Frontend Controller
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/eksplor', 'eksplor')->name('eksplor');
    Route::get('/eksplor/wisata', 'wisata')->name('wisata');
    // Butuh Middleware & Pembuatan Slug Untuk Route "Wisata"
    Route::get('/eksplor/wisata/checkout', 'checkout')->name('checkout');
    Route::get('/eksplor/wisata/pembayaran', 'pembayaran')->name('pembayaran');
    Route::get('/sukses', 'sukses')->name('sukses');
});

// Group Dashboard Controller User (Middleware)
Route::prefix('user')->group(function () {
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard-user');
        Route::get('/detail', 'detail')->name('dashboard-detail');
        Route::get('/pending', 'pending')->name('dashboard-pending');
        Route::get('/riwayat', 'riwayat')->name('dashboard-riwayat');
    });
});

// Grup Dashboard Controller Admin (Backend & Butuh Middleware)
Route::prefix('admin')->group(function () {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/', 'index');
    });
});
