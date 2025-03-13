<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory as ExcelIOFactory;
use Mpdf\Mpdf;
use App\Models\Conversion;
use App\Services\FileConverter;
use Illuminate\Support\Facades\Storage;

class FileConversionController extends Controller
{
    public function index()
    {
        return view('conversion.index');
    }

    public function convertWordExcelToPdf(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:doc,docx,xls,xlsx'
        ]);

        $file = $request->file('file');
        $outputDir = storage_path('app/public');
        $filePath = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

        if (in_array($file->getClientOriginalExtension(), ['doc', 'docx'])) {
            $pdfPath = FileConverter::convertWordToPdf(storage_path("app/public/$filePath"), $outputDir);
        } else {
            $pdfPath = FileConverter::convertExcelToPdf(storage_path("app/public/$filePath"), $outputDir);
        }
        // Rendre le fichier accessible via le navigateur
        /* $pdfUrl = asset('storage/' . basename($pdfPath));

        return view('pdf-viewer', compact('pdfUrl')); */
        return response()->download($pdfPath);
    }

    public function convertToPdf(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:doc,docx,xls,xlsx,ppt,pptx,odt,ods,odp,txt,rtf,html,jpeg,png,jpg|max:2048'
        ]);

        $file = $request->file('file');
        $outputDir = storage_path('app/public');
        // Nettoyer le nom du fichier et ajouter un horodatage unique
        $cleanFileName = preg_replace('/[^A-Za-z0-9\-]/', '_', pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        ));
        $uniqueFileName = 'Tala_' . $cleanFileName . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Stocker le fichier avec le nom unique
        $filePath = $file->storeAs('uploads', $uniqueFileName, 'public');

        // Conversion du fichier en PDF
        $pdfPath = FileConverter::convertToPdf(storage_path("app/public/$filePath"), $outputDir);

        Storage::disk('public')->delete($filePath);

        return response()->download($pdfPath)->deleteFileAfterSend(true);
    }
}