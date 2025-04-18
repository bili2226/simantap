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
Route::view('/artikel', 'layouts.artikel')->name('artikel');

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

require __DIR__.'/auth.php';
