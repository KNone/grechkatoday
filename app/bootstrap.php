<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configFileName = __DIR__ . '/config/config.yml';

use KNone\Grecha\Controller\ApiControllerProvider;
use KNone\Grecha\Controller\MainControllerProvider;
use KNone\Grecha\GrechaServiceProvider;

$app = new Silex\Application();

$app->register(new GrechaServiceProvider($configFileName));

$app->mount('/', new MainControllerProvider());
$app->mount('/api', new ApiControllerProvider());

return $app;
