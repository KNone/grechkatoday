<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';

use KNone\Entity\PriceRepository;
use KNone\View\TemplateEngine;
use Knp\Provider\ConsoleServiceProvider;

$app = new Silex\Application();

$app['debug'] = isset($config['app']['debug']) && $config['app']['debug'] === true;
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'dbs.options' => [
        'mysql' => $config['mysql'],
    ],
]);
$app['template.engine'] = new TemplateEngine();
$app['price.repository'] = new PriceRepository($app['dbs']['mysql']);
$app->register(
    new ConsoleServiceProvider(),
    [
        'console.name' => 'GrechaConsole',
        'console.version' => '1.0.0',
        'console.project_directory' => __DIR__ . '/..',
    ]
);

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

return $app;