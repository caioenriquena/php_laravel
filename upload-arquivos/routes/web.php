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


    Route::get('/report', [UploadController::class, 'generateReport'])->middleware('auth')->name('report.generate');

    Route::get('/relatorio-download', [UploadController::class, 'downloadReport'])->middleware('auth')->name('relatorio.download');

    Route::get('/report', [UploadController::class, 'generateReport'])->middleware('auth')->name('report');
    Route::post('/upload', [UploadController::class, 'upload'])->middleware('auth')->name('upload');



});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
