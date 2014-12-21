<?php

namespace KNone\Grecha\View;

use KNone\Grecha\View\Exception\InvalidTemplateNameException;
use KNone\Grecha\View\Helper as ViewHelper;

class TemplateEngine
{
    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function render($name, $params)
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

        return ob_get_clean();
    }
}
