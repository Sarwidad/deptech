<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔹 Route Resource untuk Pegawai, dan Cuti
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('cuti', CutiController::class);
    Route::resource('users', UserController::class);
    
});

require __DIR__.'/auth.php';
