<?php

namespace KNone\Grecha;

use KNone\Grecha\Entity\PriceRepository;
use KNone\Grecha\View\TemplateEngine;
use Silex\Application;
use Silex\ServiceProviderInterface;

class GrechaServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['template.engine'] = $app->share(function () {
            return new TemplateEngine();
        });
        $app['price.repository'] = $app->share(function () use ($app) {
            return new PriceRepository($app['dbs']['mysql']);
        });
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }
}