<?php

namespace Foris\Easy\Sdk\Providers;

use Foris\Easy\Cache\Cache;
use Foris\Easy\Cache\Factory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class CacheProvider
 */
class CacheProvider implements ServiceProviderInterface
{
    /**
     * Register cache component
     *
     * @param Container $app
     */
    public function register(Container $app)
    {
        !isset($app['cache_adapter']) && $app['cache_adapter'] = function () {
            return new Factory();
        };

        !isset($app['cache']) && $app['cache'] = function ($app) {
            return new Cache($app['cache_adapter'], $app->config['cache']);
        };
    }
}