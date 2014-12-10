<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';

use KNone\Grecha\Entity\PriceRepository;
use KNone\Grecha\View\TemplateEngine;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Silex\Application();

$app['debug'] = isset($config['app']['debug']) && $config['app']['debug'] === true;

$app->register(new DoctrineServiceProvider(), [
    'dbs.options' => [
        'mysql' => $config['mysql'],
    ],
]);
$app->register(
    new ConsoleServiceProvider(),
    [
        'console.name' => 'GrechaConsole',
        'console.version' => '1.0.0',
        'console.project_directory' => __DIR__ . '/..',
    ]
);

$app['template.engine'] = $app->share(function () {
    return new TemplateEngine();
});
$app['price.repository'] = $app->share(function () use ($app) {
    return new PriceRepository($app['dbs']['mysql']);
});


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