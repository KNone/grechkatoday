<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';

use KNone\Grecha\GrechaServiceProvider;
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
$app->register(new GrechaServiceProvider());

$app->get('/', function () use ($app) {
    $price = $app['grecha.price.repository']->findActualPrice();
    if (!$price) {
        die('It\'s so bad, but site is down :-(');
    }

    return $app['grecha.template.engine']->render(
        'index',
        ['price' => $price]
    );
});

return $app;