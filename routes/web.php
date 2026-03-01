<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilTokoController;
use App\Http\Controllers\PublicBookingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Karyawan;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\ProfilToko;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $banners = \App\Models\Banner::where('is_active', true)->latest()->get();
    $karyawan = Karyawan::where('status', 'aktif')->get();
    $layanan = Layanan::with('kategori')->where('is_active', true)->get();
    $profil = ProfilToko::first();
    $galeri = Galeri::latest()->get();
    $fasilitas = Fasilitas::oldest()->get();
    $totalPelanggan = Pelanggan::count();
    // dd($totalPelanggan);
    return view('welcome', compact('banners', 'karyawan', 'layanan', 'profil', 'galeri', 'fasilitas', 'totalPelanggan'));
});

// Public Booking Routes
Route::get('/booking', [PublicBookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [PublicBookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{nomor_antrian}', [PublicBookingController::class, 'success'])->name('booking.success');
Route::get('/cek-status', [PublicBookingController::class, 'checkStatus'])->name('booking.status');

// API for dependent dropdown
Route::get('/get-layanan/{kategori_id}', [LayananController::class, 'getByKategori'])->name('layanan.getByKategori');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('karyawan', KaryawanController::class)->except(['show']);
    Route::resource('layanan', LayananController::class)->except(['show']);
    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::resource('transaksi', TransaksiController::class)->except(['show']);
    Route::resource('pembayaran', PembayaranController::class)->only(['index', 'create', 'store', 'show']);

    // Laporan Routes
    Route::get('/laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');
    Route::get('/laporan/kinerja', [LaporanController::class, 'kinerja'])->name('laporan.kinerja');
    Route::get('/laporan/pelanggan', [LaporanController::class, 'pelanggan'])->name('laporan.pelanggan');

    // CMS Web Profile Routes
    Route::get('/profil-toko', [ProfilTokoController::class, 'edit'])->name('profil_toko.edit');
    Route::put('/profil-toko', [ProfilTokoController::class, 'update'])->name('profil_toko.update');
    Route::resource('galeri', GaleriController::class)->except(['show']);
    Route::resource('fasilitas', FasilitasController::class)->except(['show']);
    Route::resource('banners', \App\Http\Controllers\BannerController::class)->except(['show']);
});

require __DIR__.'/auth.php';
