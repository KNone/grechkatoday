<?php

namespace KNone\Grecha\Infrastructure\Silex\Controller;

use KNone\Grecha\Domain\PriceRepositoryInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiControllerProvider implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/price/statistics/{interval}', function ($interval, Application $app) {
            /** @var PriceRepositoryInterface $priceRepository */
            $priceRepository = $app['grecha.price.repository'];
            if ($interval === 'week') {
                $prices = $priceRepository->findPricesForWeek();
            } elseif ($interval === 'month') {
                $prices = $priceRepository->findPricesForMonth();
            } else {
                throw new NotFoundHttpException();
            }

            $response = [];

            foreach ($prices as $price) {
                $response[] = [
                    'value' => $price->getValue(),
                    'date' => $price->getDateTime()->format('d.m.Y')
                ];
            }

            return $app->json($response);
        });

        return $controllers;
    }
}
