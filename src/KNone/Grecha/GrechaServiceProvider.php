<?php

namespace KNone\Grecha;

use KNone\Grecha\Entity\Persistence\DbalExchangeRateRepository;
use KNone\Grecha\Entity\Persistence\DbalPriceRepository;
use KNone\Grecha\ExchangeRate\ExchangerFactory;
use KNone\Grecha\ExchangeRate\Importer;
use KNone\Grecha\ExchangeRate\XmlRateParser;
use KNone\Grecha\View\TemplateEngine;
use Silex\Application;
use Silex\ServiceProviderInterface;
use KNone\Grecha\Price\Importer as PriceImporter;
use KNone\Grecha\Price\Parser as PriceParser;

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
            return new DbalPriceRepository($app['dbs']['mysql']);
        });

        $app['price.importer'] = function () use ($app) {
            $parser = new PriceParser();
            return new PriceImporter($app['price.repository'], $parser);
        };

        $app['grecha.exchange_rate.repository'] = $app->share(function () use ($app) {
            return new DbalExchangeRateRepository($app['dbs']['mysql']);
        });

        $app['grecha.exchange_rate.importer'] = $app->share(function () use ($app) {
            return new Importer(new XmlRateParser(), $app['grecha.exchange_rate.repository']);
        });

        $app['grecha.exchanger_rate'] = $app->share(function () use ($app) {
            $exchangerFactory = new ExchangerFactory($app['grecha.exchange_rate.repository']);

            return $exchangerFactory->createActualExchangerRate();
        });
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }
}