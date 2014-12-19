<?php

namespace KNone\Grecha;

use Igorw\Silex\ConfigServiceProvider;
use KNone\Grecha\Entity\Persistence\DbalExchangeRateRepository;
use KNone\Grecha\Entity\Persistence\DbalPriceRepository;
use KNone\Grecha\ExchangeRate\ExchangeRateConverterFactory;
use KNone\Grecha\ExchangeRate\Importer;
use KNone\Grecha\ExchangeRate\XmlRateParser;
use KNone\Grecha\View\TemplateEngine;
use Knp\Provider\ConsoleServiceProvider;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\ServiceProviderInterface;
use KNone\Grecha\Price\Importer as PriceImporter;
use KNone\Grecha\Price\Parser as PriceParser;
use KNone\Grecha\Price\Strategy\AverageCalculationStrategy as PriceStrategy;

class GrechaServiceProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    private $configFileName;

    /**
     * @param string $configFilename
     */
    public function __construct($configFileName)
    {
        $this->configFileName = $configFileName;
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }

    /**
     * @return string
     */
    public function getConfigFileName()
    {
        return $this->configFileName;
    }

    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $this->registerConfig($app, $this->getConfigFileName());

        $register = [
                'doctrine',
                'console',
                'templateEngine',
                'price',
                'exchangeRate',
            ];

        foreach ($register as $service) {
            $this->{'register'.$service}($app);
        }
    }

    /**
     * @param Application $app
     * @param string      $config
     */
    protected function registerConfig($app, $config)
    {
        $app->register(new ConfigServiceProvider($config));
    }

    /**
     * @param Application $app
     */
    protected function registerDoctrine($app) {
        $app->register(new DoctrineServiceProvider(), [
            'dbs.options' => $app['config']['dbs'],
        ]);
    }

    /**
     * @param Application $app
     */
    protected function registerConsole($app) {
        $app->register(
            new ConsoleServiceProvider(),
            [
                'console.name' => 'GrechaConsole',
                'console.version' => '1.0.0',
                'console.project_directory' => __DIR__.'/..',
            ]
        );
    }

    /**
     * @param Application $app
     */
    protected function registerTemplateEngine($app) {
        $app['grecha.template.engine'] = $app->share(function () {
            return new TemplateEngine();
        });
    }


    /**
     * @param Application $app
     */
    protected function registerPrice(Application $app)
    {
        $app['grecha.price.repository'] = $app->share(function () use ($app) {
            return new DbalPriceRepository($app['dbs']['mysql']);
        });

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
        $app['grecha.exchange_rate.repository'] = $app->share(function () use ($app) {
            return new DbalExchangeRateRepository($app['dbs']['mysql']);
        });

        $app['grecha.exchange_rate.importer'] = $app->share(function () use ($app) {
            return new Importer(new XmlRateParser(), $app['grecha.exchange_rate.repository']);
        });

        $app['grecha.exchange_rate.converter'] = $app->share(function () use ($app) {
            $exchangerFactory = new ExchangeRateConverterFactory($app['grecha.exchange_rate.repository']);

            return $exchangerFactory->createActualExchangeRateConverter();
        });
    }
}
