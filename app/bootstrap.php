<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configFileName = __DIR__ . '/config/config.yml';

use Igorw\Silex\ConfigServiceProvider;
use KNone\Grecha\Infrastructure\Silex\Controller\ApiControllerProvider;
use KNone\Grecha\Infrastructure\Silex\Controller\MainControllerProvider;
use KNone\Grecha\Infrastructure\Silex\ApplicationServiceProvider;
use KNone\Grecha\Infrastructure\Silex\PersistenceServiceProvider;

$app = new Silex\Application();

$app->register(new ConfigServiceProvider($configFileName), array('root_dir' => realpath(__DIR__.'/../')));
//app layers
$app->register(new ApplicationServiceProvider());
$app->register(new PersistenceServiceProvider());

$app->mount('/', new MainControllerProvider());
$app->mount('/api', new ApiControllerProvider());

//todo: read db settings from $_ENV and contain to config
//$app['config']

return $app;
