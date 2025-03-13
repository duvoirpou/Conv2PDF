<?php

namespace App\Services;

use setasign\Fpdi\TcpdfFpdi;
use Illuminate\Support\Facades\Storage;

class PdfMergeService
{
    public function mergePdfs(array $files, $outputFileName)
    {
        $pdf = new TcpdfFpdi();

        $pdf->AddPage();

        foreach ($files as $file) {
            $filePath = storage_path("app/public/" . $file);

            if (!file_exists($filePath)) {
                continue;
            }

            $pageCount = $pdf->setSourceFile($filePath);

            for ($i = 1; $i <= $pageCount; $i++) {
                $tplIdx = $pdf->importPage($i);
                $pdf->AddPage();
                $pdf->useTemplate($tplIdx);
            }
        }

        $mergedFilePath = storage_path("app/public/merged/" . $outputFileName);

        Storage::makeDirectory("public/merged");
        $pdf->Output($mergedFilePath, 'F');

        return $mergedFilePath;

    }
}
