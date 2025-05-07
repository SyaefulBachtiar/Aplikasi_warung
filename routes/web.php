<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

// Read dan home
Route::get('/dashboard', [BarangController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Create barang
Route::post('/create', [BarangController::class, 'store'])->name('create.store');

// Table riwayat
Route::get('/riwayat', [TransaksiController::class, 'index'])->name('index');


// create transaksi
Route::post('/simpan-transaksi', [BarangController::class, 'transaksi'])->name('simpan-transaksi');

// detail
Route::get('/detail/{id}', [TransaksiController::class, 'detail'])->name('detail');

// Delete transaksi
Route::get('/delete/{id}', [TransaksiController::class, 'delete'])->name('delete');



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
