<?php

namespace KNone\Grecha\View;

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
        $viewPath = realpath(__DIR__ . '/../Resources/views/' . $name . '.php');
        if ($viewPath) {
            require $viewPath;
        } else {
            throw new \InvalidArgumentException('Template name "' . $name . '" is invalid.');
        }

        return ob_get_clean();
    }
}