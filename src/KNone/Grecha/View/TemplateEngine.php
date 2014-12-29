<?php

namespace KNone\Grecha\View;

use KNone\Grecha\View\Exception\InvalidTemplateNameException;
use KNone\Grecha\View\Helper as ViewHelper;

class TemplateEngine
{
    /**
     * @var \Websharks\Html_compressor\core
     */
    protected $htmlCompressor;

    /**
     * @var bool
     */
    protected $compress;

    /**
     * @param \Websharks\Html_compressor\core $htmlCompressor
     * @param bool $compress
     */
    public function __construct($htmlCompressor, $compress = true)
    {
        $this->htmlCompressor = $htmlCompressor;
        $this->compress = (bool) $compress;
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render($name, $params)
    {
        extract($params, EXTR_SKIP);

        ob_start();

        $helper = new ViewHelper();
        $viewPath = realpath(__DIR__ . '/../Resources/views/' . $name . '.php');
        if ($viewPath) {
            require $viewPath;
        } else {
            throw new InvalidTemplateNameException('Template name "' . $name . '" is invalid.');
        }

        $output = ob_get_clean();

        if ($this->needCompress()) {
            $output = $this->compressHtml($output);
        }

        return $output;
    }

    /**
     * @return \Websharks\Html_compressor\core
     */
    protected function getHtmlCompressor()
    {
        return $this->htmlCompressor;
    }

    /**
     * @return bool
     */
    protected function needCompress()
    {
        return $this->compress;
    }

    /**
     * @param  string $input
     * @return string
     */
    protected function compressHtml($input)
    {
        $compressor = $this->getHtmlCompressor();
        return $compressor->compress($input);
    }
}
