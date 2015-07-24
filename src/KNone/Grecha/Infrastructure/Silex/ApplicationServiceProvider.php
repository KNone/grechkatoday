<?php

namespace KNone\Grecha\Infrastructure\Silex;

use Silex\Application;
use Knp\Provider\ConsoleServiceProvider;
use KNone\Grecha\Application\ExchangeRate\ExchangeRateConverterFactory;
use KNone\Grecha\Application\ExchangeRate\Importer;
use KNone\Grecha\Application\ExchangeRate\XmlRateParser;
use KNone\Grecha\Infrastructure\Silex\View\TemplateEngine;
use KNone\Grecha\Application\Price\Importer as PriceImporter;
use KNone\Grecha\Application\Price\Parser as PriceParser;
use KNone\Grecha\Application\Price\Strategy\AverageCalculationStrategy as PriceStrategy;
use Websharks\Html_compressor\core as HtmlCompressor;

class ApplicationServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected function getRegisteredServices()
    {
        return [
            'console',
            'templateEngine',
            'htmlCompressor',
            'price',
            'exchangeRate',
        ];
    }

    /**
     * @param Application $app
     */
    protected function registerConsole(Application $app)
    {
        $app->register(
            new ConsoleServiceProvider(),
            [
                'console.name' => 'GrechaConsole',
                'console.version' => '1.0.0',
                'console.project_directory' => __DIR__ . '/..',
            ]
        );
    }

    /**
     * @param Application $app
     */
    protected function registerTemplateEngine(Application $app)
    {
        $app['grecha.template.engine'] = $app->share(function () use ($app) {
            return new TemplateEngine($app['grecha.template.compressor'], $app['config']['template']['compress']);
        });
    }

    /**
     * @param Application $app
     */
    protected function registerHtmlCompressor(Application $app)
    {

        $app['grecha.template.compressor'] = function () use ($app) {
            $config = [
                'cache_dir_private' => $app['root_dir'] . '/' . $app['config']['cache']['dir']['backend'],
                'cache_dir_public' => $app['root_dir'] . '/' . $app['config']['cache']['dir']['frontend'],
                'cache_dir_url_public' => $app['config']['cache']['public_cdn_url'],
                'cache_expiration_time' => $app['debug'] ? '1 seconds' : $app['config']['cache']['template_cache_time'],
                'benchmark' => $app['debug'],
            ];

            return new HtmlCompressor($config);
        };
    }

    /**
     * @param Application $app
     */
    protected function registerPrice(Application $app)
    {
        $app['grecha.price.price_strategy'] = function () use ($app) {
            $strategyParams = $app['config']['price']['strategy'];

            return new PriceStrategy(
                $strategyParams['average'],
                $strategyParams['deviation'],
                $strategyParams['retail_rate']
            );
        };

        $app['grecha.price.importer'] = function () use ($app) {
            return new PriceImporter($app['grecha.price.repository'], new PriceParser(), $app['grecha.price.price_strategy']);
        };
    }

    /**
     * @param Application $app
     */
    protected function registerExchangeRate(Application $app)
    {
        $app['grecha.exchange_rate.importer'] = $app->share(function () use ($app) {
            return new Importer(new XmlRateParser(), $app['grecha.exchange_rate.repository']);
        });

        $app['grecha.exchange_rate.converter'] = $app->share(function () use ($app) {
            $exchangerFactory = new ExchangeRateConverterFactory($app['grecha.exchange_rate.repository']);

            return $exchangerFactory->createActualExchangeRateConverter();
        });
    }
}
