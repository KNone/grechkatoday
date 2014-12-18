<?php

namespace KNone\Grecha\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class MainControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];
        $controllers->get('/', function (Application $app) {
            $price = $app['grecha.price.repository']->findActualPrice();
            $exchanger = $app['grecha.exchanger_rate'];
            if (!$price) {
                die('It\'s so bad, but site is down :-(');
            }

            return $app['grecha.template.engine']->render(
                'index',
                [
                    'price' => $price,
                    'exchanger' => $exchanger
                ]
            );
        });

        return $controllers;
    }
}
