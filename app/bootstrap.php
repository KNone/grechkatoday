<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = __DIR__ . '/config.yml';

use KNone\Grecha\GrechaServiceProvider;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Igorw\Silex\ConfigServiceProvider;

$app = new Silex\Application();

$app->register(new ConfigServiceProvider($config));

$app->register(new DoctrineServiceProvider(), [
    'dbs.options' => $app['config']['dbs'],
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