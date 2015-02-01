<?php

namespace KNone\Grecha\Preview;

use Symfony\Component\Process\ProcessBuilder;

class PreviewCreator implements PreviewCreatorInterface
{
    /**
     * @param string $filePath
     */
    public function createPreview($filePath)
    {
        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix('cutycapt');
        $processBuilder->setTimeout(3600);

        $arguments = [
            '--url=http://grechkatoday.ru',
            '--out=' . $filePath
        ];
        $processBuilder->setArguments($arguments);
        $processBuilder->getProcess()->run();
    }
}

