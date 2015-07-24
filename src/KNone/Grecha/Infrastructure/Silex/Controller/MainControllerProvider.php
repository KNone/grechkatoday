<?php

namespace KNone\Grecha\Infrastructure\Silex\Controller;

use KNone\Grecha\Domain\PriceRepositoryInterface;
use KNone\Grecha\Application\ExchangeRate\ExchangeRateConverter;
use KNone\Grecha\Domain\ViewModel\PricePresenter;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class MainControllerProvider implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];
        $controllers->get('/', function (Application $app) {

            /** @var PriceRepositoryInterface $priceRepository */
            $priceRepository = $app['grecha.price.repository'];

            /** @var ExchangeRateConverter $exchangeRateConverter */
            $exchangeRateConverter = $app['grecha.exchange_rate.converter'];

            $pricePresenter = new PricePresenter(
                $priceRepository->getPriceStack(),
                $exchangeRateConverter
            );

            return $app['grecha.template.engine']->render(
                'index',
                [
                    'pricePresenter' => $pricePresenter,
                    'debug' => $app['debug']
                ]
            );
        });

        return $controllers;
    }
}
