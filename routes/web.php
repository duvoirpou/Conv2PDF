<?php

use App\Http\Controllers\FileConversionController;
use App\Http\Controllers\PdfCompressController;
use App\Http\Controllers\PdfMergeController;
use Illuminate\Support\Facades\Route;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use setasign\Fpdi\TcpdfFpdi;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [FileConversionController::class, 'index'])->name('conversion.index');
Route::post('/convert-to-pdf', [FileConversionController::class, 'convertToPdf'])->name('convert-and-download');
Route::get('/merge-pdf', [PdfMergeController::class, 'index'])->name('fusionner.pdf');
Route::post('/merge-pdf', [PdfMergeController::class, 'mergePdfs'])->name('merge.pdf');
Route::get('/compresser-pdf', [PdfCompressController::class, 'compressForm'])->name('form.compress');
Route::post('/compress-pdf', [PdfCompressController::class, 'compress'])->name('pdf.compress');

Route::get('/test-fpdi', function () {
    $pdf = new TcpdfFpdi();
    return "FPDI fonctionne correctement !";
});