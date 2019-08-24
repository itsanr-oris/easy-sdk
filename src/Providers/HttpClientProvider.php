<?php

namespace Foris\Easy\Sdk\Providers;

use Foris\Easy\HttpClient\HttpClient;
use Foris\Easy\HttpClient\Middleware\LogMiddleware;
use Foris\Easy\HttpClient\Middleware\RetryMiddleware;
use Foris\Easy\Logger\Driver\Factory;
use Foris\Easy\Logger\Logger;
use Foris\Easy\Sdk\ServiceContainer;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class HttpClientProvider
 */
class HttpClientProvider implements ServiceProviderInterface
{
    /**
     * Register http-client component
     *
     * @param Container $app
     */
    public function register(Container $app)
    {
        !isset($app['http_client']) && $app['http_client'] = function ($app) {
            $client = new HttpClient($app->config['http_client']);

            $this->addLogMiddleware($app, $client);
            $this->addRetryMiddleware($app, $client);

            return $client;
        };
    }

    /**
     * Add log middleware
     *
     * @param ServiceContainer $app
     * @param HttpClient       $client
     * @throws \Foris\Easy\Logger\Exception\InvalidConfigException
     */
    protected function addLogMiddleware(ServiceContainer $app, HttpClient $client)
    {
        $logger = $app['logger'] ?? new Logger(new Factory());
        $client->pushMiddleware(new LogMiddleware($logger, $app->config['http_client'] ?? []));
    }

    /**
     * Add retry middleware
     *
     * @param ServiceContainer $app
     * @param HttpClient       $client
     */
    protected function addRetryMiddleware(ServiceContainer $app, HttpClient $client)
    {
        $client->pushMiddleware(new RetryMiddleware($app->config['http_client'] ?? []));
    }
}