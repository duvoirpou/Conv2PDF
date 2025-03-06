<?php

use App\Http\Controllers\FileConversionController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [FileConversionController::class, 'index'])->name('conversion.index');
Route::post('/convert-to-pdf', [FileConversionController::class, 'convertToPdf'])->name('convert-and-download');
