<?php

namespace Foris\Easy\Sdk\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Foris\Easy\Logger\Logger;
use Foris\Easy\Logger\Driver\Factory;

/**
 * Class LoggerProvider
 */
class LoggerProvider implements ServiceProviderInterface
{
    /**
     * Register logger component
     *
     * @param Container $app
     */
    public function register(Container $app)
    {
        !isset($app['logger_driver']) && $app['logger_driver'] = function () {
            return new Factory();
        };

        !isset($app['logger']) && $app['logger'] = function ($app) {
            return new Logger($app['logger_driver'], $app->config['log']);
        };
    }
}