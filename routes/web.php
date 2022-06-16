<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PengembanganController;
use App\Http\Controllers\PengembanganWisataController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    Route::get('/eksplor/{wisata:slug}', 'wisata')->name('detail-wisata');
    Route::get('/invest', 'invest')->name('invest');
    Route::get('/invest/wisata', 'InvestWisata')->name('invest-wisata');
});
// Butuh Middleware Untuk Route "Wisata"
Route::controller(FrontendController::class)->middleware('User')->group(function () {
    Route::get('/eksplor/{wisata:slug}/checkout', 'checkout')->name('checkout');
    Route::get('/eksplor/{wisata:slug}/pembayaran', 'pembayaran')->name('pembayaran');
    Route::get('/invest/wisata/pembayaran', 'pembayaraninvest')->name('pembayaran-invest');
    Route::get('/sukses', 'sukses')->name('sukses');
});

// Group Dashboard Controller User (Frontend)
Route::controller(UserDashboardController::class)->prefix('user')->middleware('User')->group(function () {
    Route::get('/', 'index')->name('dashboard-user');
    Route::get('/detail', 'detail')->name('dashboard-detail');
    Route::get('/pending', 'pending')->name('dashboard-pending');
    Route::get('/riwayat', 'riwayat')->name('dashboard-riwayat');
});


// Grup Dashboard Controller Admin (Backend)
Route::middleware('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/', 'index');
    });
    Route::resource('rekening', RekeningController::class);
    Route::resource('wisata', WisataController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('pengembanganWisata', PengembanganWisataController::class);
    Route::resource('gallery', GalleryController::class);
});

// Group Login,Register,Forgot
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'auth');
    Route::post('/logout', 'logout');

    Route::get('/register', 'register')->name('register')->middleware('guest');
    Route::post('/register', 'registerStore');

    Route::get('/forgot', 'forgot')->name('forgot')->middleware('guest');
});

// Route Change Role
Route::post('/roles', [UserController::class, 'changeRole'])->middleware('User');

// Route Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
