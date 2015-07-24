<?php

namespace KNone\Grecha\Application\Preview;

use Symfony\Component\Process\Process;

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

