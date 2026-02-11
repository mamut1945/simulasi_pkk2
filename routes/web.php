<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


    Route::resource('kamar', KamarController::class);
    Route::get('riwayat-reservasi', 
        [ReservasiController::class, 'riwayat'])
        ->name('reservasi.riwayat');
    Route::patch('/reservasi/{reservasi}/status', [ReservasiController::class, 'updateStatus'])
     ->name('reservasi.updateStatus');
     


});

Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('reservasi', 
        [ReservasiController::class, 'index'])
        ->name('reservasi.index');

    Route::get('reservasi/{kamar}/create', 
        [ReservasiController::class, 'create'])
        ->name('reservasi.create');
Route::post('/reservasi', [ReservasiController::class, 'store'])
    ->name('reservasi.store');

});

Route::get('/redirect', function () {

    if (Auth::user()->role === 'admin') {
        return redirect()->route('kamar.index');
    }

    return redirect()->route('reservasi.index');
})->middleware('auth');


require __DIR__.'/auth.php';
