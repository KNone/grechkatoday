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
     * @param \Websharks\Html_compressor\core $htmlCompressor
     */
    public function __construct($htmlCompressor)
    {
        $this->htmlCompressor = $htmlCompressor;
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

        return $this->compressHtml(ob_get_clean());
    }

    /**
     * @return \Websharks\Html_compressor\core
     */
    protected function getHtmlCompressor()
    {
        return $this->htmlCompressor;
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
