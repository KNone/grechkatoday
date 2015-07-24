<?php

namespace KNone\Grecha\Infrastructure\Silex;

use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use KNone\Grecha\Infrastructure\Persistence\Repository\ExchangeRateRepository;
use KNone\Grecha\Infrastructure\Persistence\Repository\PriceRepository;

class PersistenceServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected function getRegisteredServices()
    {
        return [
            'doctrine',
            'priceRepository',
            'exchangeRateRepository',
        ];
    }

    /**
     * @param Application $app
     */
    protected function registerDoctrine(Application $app)
    {
        $app->register(new DoctrineServiceProvider(), [
            'dbs.options' => $app['config']['dbs'],
        ]);
    }

    /**
     * @param Application $app
     */
    protected function registerPriceRepository(Application $app)
    {
        $app['grecha.price.repository'] = $app->share(function () use ($app) {
            return new PriceRepository($app['dbs']['mysql']);
        });
    }

    /**
     * @param Application $app
     */
    protected function registerExchangeRateRepository(Application $app)
    {
        $app['grecha.exchange_rate.repository'] = $app->share(function () use ($app) {
            return new ExchangeRateRepository($app['dbs']['mysql']);
        });
    }
}
