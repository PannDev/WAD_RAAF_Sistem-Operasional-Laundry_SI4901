<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LaundryController;

Route::get('/portal', [LaundryController::class, 'index']);
Route::get('/portal/pengaturan', [LaundryController::class, 'pengaturan']);
Route::get('/portal/tambah', [LaundryController::class, 'create']);
Route::post('/portal/simpan', [LaundryController::class, 'store']);
Route::get('/portal/edit/{id}', [LaundryController::class, 'edit']);
Route::post('/portal/update/{id}', [LaundryController::class, 'update']);
Route::get('/portal/hapus/{kategori}/{id}', [LaundryController::class, 'destroy']);