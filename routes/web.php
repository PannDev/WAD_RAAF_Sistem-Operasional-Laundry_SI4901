<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return redirect()->route('pelanggan.index');
    })->name('home');

    Route::resource('pelanggan', PelangganController::class)->except(['create', 'show']);
});