<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/home', 'layouts.home')->name('home');

// Route untuk halaman artikel
use App\Models\Artikel;
Route::get('/artikel', function () {
    $artikels = Artikel::orderBy('created_at', 'desc')->get();
    return view('layouts.artikel', compact('artikels'));
})->name('artikel');

// Route untuk halaman mualaf
use App\Http\Controllers\MualafController;
Route::get('/mualaf', [MualafController::class, 'create'])->name('mualaf');
Route::post('/mualaf', [MualafController::class, 'store'])->name('mualaf.store');

use App\Http\Controllers\InformasiController;
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');

use App\Http\Controllers\ReservasiController;
Route::get('/reservasi', [ReservasiController::class, 'create'])->name('reservasi');
Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');

use App\Http\Controllers\ZakatController;
Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat');

// Route untuk halaman admin panel
Route::view('/admin', 'layouts.admin.admin')->name('admin');

use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\AdminBeritaController;
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('artikel', AdminArtikelController::class);
    Route::resource('berita', AdminBeritaController::class);
});

use App\Models\Berita;
Route::get('/berita', function () {
    $beritas = Berita::orderBy('created_at', 'desc')->get();
    return view('layouts.berita', compact('beritas'));
})->name('berita');

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\GaleriController;
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store');

require __DIR__.'/auth.php';
