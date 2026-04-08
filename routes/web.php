<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\PesananController;

// -------------------- PUBLIC ROUTES --------------------

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', fn () => view('about'))->name('about');

// Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/kategori/{id}', [ProdukController::class, 'kategori'])->name('produk.kategori');

// -------------------- AUTH ROUTES (GUEST) --------------------

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// -------------------- AUTH ROUTES (LOGGED IN) --------------------

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout
    Route::get('/checkout/metode', [CheckoutController::class, 'metode'])->name('checkout.metode');
    Route::post('/checkout', [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::post('/checkout/langsung', [CheckoutController::class, 'beliLangsung'])->name('checkout.langsung');
    Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])->name('checkout.sukses');

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/{produk}/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    Route::patch('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');

    // Pesanan
    Route::get('/pesanan-saya', [PesananController::class, 'riwayat'])->name('pesanan.riwayat');
    Route::get('/pesanan/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');

    // Email Verification
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')->name('verification.send');

    // Password
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// -------------------- MIDTRANS CALLBACK (DILUAR AUTH) --------------------
Route::post('/midtrans/callback', [CheckoutController::class, 'handleCallback']);
Route::post('/checkout/callback', [CheckoutController::class, 'handleCallback']);
