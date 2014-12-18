<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configFileName = __DIR__ . '/config/config.yml';

use KNone\Grecha\GrechaServiceProvider;

$app = new Silex\Application();

$app->register(new GrechaServiceProvider($configFileName));

$app->get('/', function () use ($app) {
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

return $app;
