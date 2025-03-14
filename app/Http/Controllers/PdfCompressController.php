<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ilovepdf\Ilovepdf;
use App\Services\PdfCompressor;

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

    public function compress(Request $request)
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
    }

    /*
    public function compress(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240' // Max 10 MB
        ]);

        // 📂 Stocker le fichier PDF temporairement
        $file = $request->file('pdf_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/uploads', $fileName);

        // 📌 Chemin du fichier à compresser
        $inputFilePath = storage_path('app/' . $filePath);

        // 🔥 Compresser le PDF avec le service
        $compressedFilePath = $this->pdfCompressor->compressPdf($inputFilePath);

        if (!$compressedFilePath) {
            return back()->with('error', 'Erreur lors de la compression.');
        }

        // 📥 Télécharger le fichier compressé et supprimer après envoi
        return response()->download($compressedFilePath)->deleteFileAfterSend(true);
    }
    */
}