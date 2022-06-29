<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PengembanganController;
use App\Http\Controllers\PengembanganWisataController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ReservasiPaketWisataController;
use App\Http\Controllers\ReservasiWisataController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\WisataController;
use App\Models\ReservasiPaketWisata;
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

// Grup Frontend Controller (Guest)
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');

    // wisata
    Route::get('/eksplor', 'eksplor')->name('eksplor');
    Route::get('/eksplor/{wisata:slug}', 'wisata')->name('detail-wisata');

    // invest
    Route::get('/invest', 'invest')->name('invest');
    Route::get('/invest/{wisata:slug}', 'InvestWisata')->name('invest-wisata');

    // paket
    Route::get('/paket', 'paket')->name('paket-wisata');
    Route::get('/paket/{paket:slug}', 'paketWisata')->name('detail-paket');
});
// Group Frontend Controller (Auth)
Route::controller(FrontendController::class)->middleware('User')->group(function () {

    // wisata
    Route::get('/eksplor/{wisata:slug}/checkout', 'checkout')->name('checkout');
    Route::post('/eksplor/{wisata:slug}/pembayaran', 'pembayaranWisataStore')->name('pembayaran-wisata');
    Route::get('/eksplor/{wisata:slug}/pembayaran/{ReservasiWisata}', 'pembayaranWisata')->name('payment-wisata');
    Route::post('/eksplor/{reservasiWisata}/upload', 'wisataUpload')->name('wisataUpload');

    // invest
    Route::post('/invest/{wisata:slug}/pembayaran', 'pembayaraninveststore')->name('pembayaran-invest');
    Route::get('/invest/{wisata:slug}/pembayaran/{pengembangan}', 'pembayaraninvest')->name('payment-invest');
    Route::post('/invest/{pengembangan}/upload', 'investUpload')->name('investUpload');

    // paket
    Route::get('/paket/{paket:slug}/checkout', 'checkoutPaket')->name('checkout-paket');
    Route::post('/paket/{paket:slug}/pembayaran', 'pembayaranPaketStore')->name('pembayaran-paket');
    Route::get('/paket/{paket:slug}/pembayaran/{ReservasiPaketWisata}', 'pembayaranPaket')->name('payment-paket');
    Route::post('/paket/{ReservasiPaketWisata}/upload', 'paketUpload')->name('paketUpload');

    Route::get('/sukses', 'sukses')->name('sukses');
});

// Group User Dashboard Controller (Auth)
Route::controller(UserDashboardController::class)->prefix('user')->middleware('User')->group(function () {
    Route::get('/', 'index')->name('dashboard-user');
    Route::put('/update/{user}', 'bioUpdate')->name('dashboard-update');
    Route::get('/riwayat/detail/{reservasi_wisata}', 'detail')->name('dashboard-detail');
    Route::get('/pending', 'pending')->name('dashboard-pending');
    Route::get('/riwayat', 'riwayat')->name('dashboard-riwayat');
});


// Grup Admin Dashboard Controller (Backend)
Route::middleware('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/', 'index');
    });
    Route::resource('rekening', RekeningController::class);
    Route::resource('wisata', WisataController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('pengembanganWisata', PengembanganWisataController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('verifikasi-wisata', ReservasiWisataController::class);
    Route::resource('verifikasi-paket', ReservasiPaketWisataController::class);
    Route::resource('verifikasi-pengembangan', PengembanganController::class);
    // Route::get('/users', [UserController::class, 'index']);
    // Route::get('/users/edit/{user}', [UserController::class, 'edit']);
    // Route::put('/users/update/{user}', [UserController::class, 'update']);
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
Route::post('/roles', [UserController::class, 'changeRole'])->middleware('User')->name('roles');

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
