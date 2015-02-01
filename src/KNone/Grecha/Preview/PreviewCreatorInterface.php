<?php

namespace KNone\Grecha\Preview;

interface PreviewCreatorInterface
{
    /**
     * @param string $filePath
     */
    public function createPreview($filePath);
}
