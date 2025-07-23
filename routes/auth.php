<?php

use Illuminate\Support\Facades\Route;

Route::middleware('redirect')->group(function () {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
    Route::post('/', [App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
