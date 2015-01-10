<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configFileName = __DIR__ . '/config/config.yml';

use Igorw\Silex\ConfigServiceProvider;
use KNone\Grecha\Controller\ApiControllerProvider;
use KNone\Grecha\Controller\MainControllerProvider;
use KNone\Grecha\GrechaServiceProvider;
use KNone\GrechaPersistence\GrechaPersistenceServiceProvider;

$app = new Silex\Application();

$app->register(new ConfigServiceProvider($configFileName), array('root_dir' => realpath(__DIR__.'/../')));
//app layers
$app->register(new GrechaServiceProvider());
$app->register(new GrechaPersistenceServiceProvider());

$app->mount('/', new MainControllerProvider());
$app->mount('/api', new ApiControllerProvider());

return $app;
