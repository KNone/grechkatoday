<?php

namespace KNone\View;

class TemplateEngine
{
    public static function render($name, $params)
    {
        extract($params, EXTR_SKIP);
        ob_start();
        $viewPath = realpath(__DIR__ . '/../views/' . $name . '.php');
        if ($viewPath) {
            require $viewPath;
        } else {
            throw new \InvalidArgumentException('Template name "' . $name . '" is invalid.');
        }
        return ob_get_clean();
    }
}