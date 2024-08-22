<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload', [UploadController::class, 'upload']);

Route::middleware(['auth'])->group(function () {
    Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
    // Outras rotas que você quer proteger
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
