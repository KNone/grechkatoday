<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../app/config.php';

use KNone\Entity\PriceRepository;
use KNone\View\TemplateEngine;

$app = new Silex\Application();

$app['debug'] = isset($config['app']['debug']) && $config['app']['debug'] === true;
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'dbs.options' => [
        'mysql' => $config['mysql'],
    ],
]);
$app['template.engine'] = new TemplateEngine();
$app['price.repository'] = new PriceRepository($app['dbs']['mysql']);

$app->get('/', function () use ($app) {
    $price = $app['price.repository']->findLastPrice();
    if (!$price) {
        die('It\'s so bad, but site is down :-(');
    }

    return $app['template.engine']->render(
        'index',
        ['price' => $price]
    );
});

$app->run();
