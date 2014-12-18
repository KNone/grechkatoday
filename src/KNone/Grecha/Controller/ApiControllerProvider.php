<?php

namespace KNone\Grecha\Controller;

use KNone\Grecha\Entity\PriceRepositoryInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/prices/{interval}', function ($interval, Request $request, Application $app) {
            if (!$request->isXmlHttpRequest()) {
                throw new NotFoundHttpException();
            }
            /** @var PriceRepositoryInterface $priceRepository */
            $priceRepository = $app['grecha.price.repository'];
            if ($interval === 'week') {
                $prices = $priceRepository->findPricesForWeek();
            } else if ($interval === 'month') {
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
