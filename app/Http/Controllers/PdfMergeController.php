<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\TcpdfFpdi;

class PdfMergeController extends Controller
{
    protected $pdfMergeService;

    /* public function __construct(PdfMergeService $pdfMergeService)
    {
        $this->pdfMergeService = $pdfMergeService;
    } */

    public function index()
    {
        return view('fusion.pdf-merge');
    }

    /* public function mergePdfs(Request $request)
    {
        // Validation
        $request->validate([
            'pdf_files' => 'required|array',
            'pdf_files.*' => 'mimes:pdf|max:10240' // 10 Mo max par fichier
        ]);

        // Stocker temporairement les fichiers
        $files = [];
        foreach ($request->file('pdf_files') as $pdf) {
            $fileName = time() . '-' . Str::random(5) . '.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('public/temp', $fileName);
            $files[] = "temp/$fileName";
        }

        // Générer un nom unique pour le fichier fusionné
        $mergedFileName = "merged-" . time() . ".pdf";

        // Fusionner les fichiers PDF
        $mergedFilePath = $this->pdfMergeService->mergePdfs($files, $mergedFileName);

        // Supprimer les fichiers temporaires après la fusion
        foreach ($files as $file) {
            Storage::delete("public/$file");
        }

        // Télécharger le fichier fusionné
        return response()->download($mergedFilePath)->deleteFileAfterSend(true);
    } */

    public function mergePdfs(Request $request)
    {
        $request->validate([
            'pdf_files.*' => 'required|mimes:pdf|max:2048',
        ]);

        $pdf = new TcpdfFpdi();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        foreach ($request->file('pdf_files') as $file) {
            $pageCount = $pdf->setSourceFile($file->getPathname());
            for ($i = 1; $i <= $pageCount; $i++) {
                $tplIdx = $pdf->importPage($i);
                $pdf->AddPage();
                $pdf->useTemplate($tplIdx);
            }
        }

        $outputPath = storage_path('app/merged-' . time() . '.pdf');
        $pdf->Output($outputPath, 'F'); // Sauvegarde le fichier

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}