<?php

namespace Foris\Easy\Sdk\Providers;

use Foris\Easy\Sdk\ServiceContainer;
use Foris\Easy\Support\Collection;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ConfigProvider
 */
class ConfigProvider implements ServiceProviderInterface
{
    /**
     * Register config component
     *
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        !isset($app['config']) && $app['config'] = function (ServiceContainer $app) {
            return new Collection($app->getConfig());
        };
    }
}