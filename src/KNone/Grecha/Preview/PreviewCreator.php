<?php

namespace KNone\Grecha\Preview;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class PreviewCreator implements PreviewCreatorInterface
{
    /**
     * @param string $filePath
     */
    public function createPreview($filePath)
    {
        $process = new Process('xvfb-run --server-args="-screen 0, 1024x768x24" cutycapt --url=http://grechkatoday.ru --out=' . $filePath);
        $process->run();
    }
}

