<?php

use App\Http\Controllers\MesinController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return redirect()->route('mesin.index');
    })->name('home');

    Route::resource('mesin', MesinController::class)->except(['create', 'show']);
});