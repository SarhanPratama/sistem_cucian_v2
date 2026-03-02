<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicBookingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('booking.create');
});

// Public Booking Routes
Route::get('/booking', [PublicBookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [PublicBookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{nomor_antrian}', [PublicBookingController::class, 'success'])->name('booking.success');
Route::get('/cek-status', [PublicBookingController::class, 'checkStatus'])->name('booking.status');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/layanan/by-kategori/{kategori}', [LayananController::class, 'getByKategori'])->name('layanan.byKategori');

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('karyawan', KaryawanController::class)->except(['show']);
    Route::resource('layanan', LayananController::class)->except(['show']);
    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::resource('transaksi', TransaksiController::class);
});

require __DIR__ . '/auth.php';
