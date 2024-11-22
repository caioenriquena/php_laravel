<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/', function () {
    return view('welcome');
});






Route::middleware(['auth'])->group(function () {
    Route::get('/upload', function () {
        return view('upload');
    })->name('upload.form');



    Route::post('/upload', [UploadController::class, 'upload'])->middleware('auth')->name('upload.store');


    Route::get('/report', [UploadController::class, 'generateReport'])->name('report.generate');


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
