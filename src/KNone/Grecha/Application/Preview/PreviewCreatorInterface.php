<?php

namespace KNone\Grecha\Application\Preview;

interface PreviewCreatorInterface
{
    /**
     * @param string $filePath
     */
    public function createPreview($filePath);
}
