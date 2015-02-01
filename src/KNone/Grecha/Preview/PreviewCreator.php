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
        $this->snapshot($filePath);

    }

    private function snapshot($filePath)
    {
        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix('cutycapt');
        $processBuilder->setTimeout(3600);

        $arguments = [
            '--url=http://grechkatoday.ru',
            '--out=' . $filePath
        ];
        var_dump($filePath);
        $processBuilder->setArguments($arguments);
        $processBuilder->getProcess()->run();

//        cutycapt --url=http://grechkatoday.ru --out=t.png
    }

}

