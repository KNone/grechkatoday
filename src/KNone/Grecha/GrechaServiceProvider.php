<?php

namespace KNone\Grecha;

use KNone\Grecha\Entity\ExchangeRateRepository;
use KNone\Grecha\Entity\PriceRepository;
use KNone\Grecha\ExchangeRate\Importer;
use KNone\Grecha\ExchangeRate\XmlRateParser;
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
        $app['grecha.template.engine'] = $app->share(function () {
            return new TemplateEngine();
        });

        $app['grecha.price.repository'] = $app->share(function () use ($app) {
            return new PriceRepository($app['dbs']['mysql']);
        });

        $app['grecha.exchange_rate.repository'] = $app->share(function () use ($app) {
            return new ExchangeRateRepository($app['dbs']['mysql']);
        });

        $app['grecha.exchange_rate.importer'] = $app->share(function () use ($app) {
            return new Importer(new XmlRateParser(), $app['grecha.exchange_rate.repository']);
        });
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }
}