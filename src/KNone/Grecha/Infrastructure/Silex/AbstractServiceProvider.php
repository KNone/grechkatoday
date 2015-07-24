<?php

namespace KNone\Grecha\Infrastructure\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;

abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }

    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        foreach ($this->getRegisteredServices() as $service) {
            $this->{'register' . $service}($app);
        }
    }

    /**
     * @return array List of services for registration
     */
    abstract protected function getRegisteredServices();
}
