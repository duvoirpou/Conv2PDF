<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

class FileConverter
{
    public static function convertToPdf($filePath, $outputDir)
    {
        // Définition du nom de sortie
        $pdfFilePath = $outputDir . '/' . pathinfo($filePath, PATHINFO_FILENAME) . '.pdf';

        // Commande LibreOffice pour la conversion
        $process = new Process([
        'libreoffice',
        '--headless',
        '--convert-to', 'pdf',
        '--outdir', $outputDir,
        $filePath
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
        throw new \RuntimeException("Erreur de conversion LibreOffice : " . $process->getErrorOutput());
        }

        return $pdfFilePath;
    }

    public static function convertWordToPdf($wordFilePath, $outputDir)
    {
        $pdfFilePath = $outputDir . '/' . pathinfo($wordFilePath, PATHINFO_FILENAME) . '.pdf';

        $process = new Process(['libreoffice', '--headless', '--convert-to', 'pdf', '--outdir', $outputDir, $wordFilePath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $pdfFilePath;
    }

    public static function convertExcelToPdf($excelFilePath, $outputDir)
    {
        $spreadsheet = IOFactory::load($excelFilePath);
        $pdfFilePath = $outputDir . '/' . pathinfo($excelFilePath, PATHINFO_FILENAME) . '.pdf';

        $writer = new Mpdf($spreadsheet);
        $writer->save($pdfFilePath);

        return $pdfFilePath;
    }
}
