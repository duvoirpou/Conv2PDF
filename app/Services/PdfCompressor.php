<?php

namespace App\Services;

use Ilovepdf\Ilovepdf;
use Ilovepdf\CompressTask;

class PdfCompressor
{
    protected $ilovepdf;

    public function __construct()
    {
        $this->ilovepdf = new Ilovepdf('project_public_51a5782c94a26bdc292daead06b4714c_adc2V765c5c489bf0382d6c92955e6197fb5a', 'secret_key_dd846d7db5b559fef1efc924b31fa650_xfBBX28c7ee6edf2407e22e05d92dfee13502');
    }

    /* public function compressPdf($inputFilePath, $outputFilePath)
    {
        $task = $this->ilovepdf->newTask('compress');
        $file = $task->addFile($inputFilePath);
        $task->execute();
        $task->download(storage_path('app/public/compressed/' . $file->getName()));

        return $outputFilePath;
    } */

    public function compressPdf($inputFilePath, $outputFilePath)
    {
        $command = "gs -sDEVICE=pdfwrite -dPrinted=false -dPDFFitPage -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile={$outputFilePath} {$inputFilePath}";

        $output = shell_exec($command);

        return $outputFilePath;
    }
}
