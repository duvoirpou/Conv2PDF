<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ilovepdf\Ilovepdf;
use App\Services\PdfCompressor;
use Symfony\Component\Process\Process;

class PdfCompressController extends Controller
{
    protected $pdfCompressor;

    public function __construct(PdfCompressor $pdfCompressor)
    {
        $this->pdfCompressor = $pdfCompressor;
    }

    public function compressForm()
    {
        return view('compress.index');
    }

    /* public function compress(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240' // Max 10 MB
        ]);

        // 📂 Stocker le fichier PDF temporairement
        $file = $request->file('pdf_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('compressed', $fileName);

        // 📌 Chemin du fichier
        $inputFilePath = storage_path('app/public/' . $filePath);
        $outputFolder = storage_path('app/public/compressed/');
        $compressedFileName = $fileName;
        // 🔥 Utiliser iLovePDF pour compresser le PDF
        try {
            $ilovepdf = new Ilovepdf(
                config('services.ilovepdf.public_key'),
                config('services.ilovepdf.secret_key')
            );

            $task = $ilovepdf->newTask('compress');
            $task->addFile($inputFilePath);
            $task->execute();
            $task->download($outputFolder);

            $compressedFilePath = $outputFolder . $compressedFileName;

            // 📥 Télécharger le fichier compressé
            return response()->download($compressedFilePath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la compression : ' . $e->getMessage());
        }
    } */

    public function compress(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:51200', // Max 50MB
        ]);

        $file = $request->file('pdf_file');
        //dd($file);
        $originalPath = $file->store('uploads', 'public'); // Stocke le fichier
        $originalFilePath = storage_path("app/public/$originalPath");

        $compressedFileName = 'compressed_' . time() . '.pdf';
        $compressedFilePath = storage_path("app/public/compressed/$compressedFileName");

        if (!file_exists(storage_path("app/public/compressed"))) {
            mkdir(storage_path("app/public/compressed"), 0777, true);
        }

        try {
            $compressor = new PdfCompressor();
            $compressor->compressPdf($originalFilePath, $compressedFilePath);

            return response()->download($compressedFilePath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->with('error', "Erreur lors de la compression : " . $e->getMessage());
        }
    }

    /* public function compress(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240'  // Limite de taille à 10MB
        ]);

        // Enregistrer le fichier téléchargé
        $file = $request->file('pdf_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/compressed', $fileName);

        $inputFilePath = storage_path('app/public/' . $filePath);
        $outputFilePath = storage_path('app/public/compressed/' . $fileName);

        // Compression du PDF
        $compressedFilePath = $this->pdfCompressor->compressPdf($inputFilePath, $outputFilePath);

        // Retourner le fichier compressé pour téléchargement
        return response()->download($compressedFilePath)->deleteFileAfterSend(true);
    } */

    /* public function compressPdf(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|file',
        ]);

        $file = $request->file('pdf_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('compressed', $fileName);

        $inputFilePath = storage_path('app/' . $filePath);
        $outputFilePath = storage_path('app/public/compressed/' . $fileName);

        $process = new Process([
            'gs',
            '-sDEVICE=pdfwrite',
            '-dCompatibilityLevel=1.4',
            '-dPDFSETTINGS=/screen',
            '-dDownsampleColorImages=/Bicubic,150',
            '-dDownsampleGrayImages=/Bicubic,150',
            '-dDownsampleMonoImages=/Bicubic,150',
            '-dOptimize=true',
            '-dCompressObjects=true',
            '-dPrinted=true',
            '-dFitPage',
            '-dNOPAUSE',
            '-dQUIET',
            '-dBATCH',
            '-sOutputFile=' . $outputFilePath,
            $inputFilePath,
        ]);

        $process->run();



        return response()->download($outputFilePath)->deleteFileAfterSend(true);
    } */
}