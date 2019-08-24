<?php

namespace Foris\Easy\Sdk;

use Pimple\Container;
use Foris\Easy\Sdk\Providers\CacheProvider;
use Foris\Easy\Sdk\Providers\ConfigProvider;
use Foris\Easy\Sdk\Providers\HttpClientProvider;
use Foris\Easy\Sdk\Providers\LoggerProvider;

/**
 * Class ServiceContainer
 *
 * @property \Foris\Easy\Cache\Cache $cache
 * @property \Foris\Easy\Support\Collection $config
 * @property \Foris\Easy\Logger\Logger $logger
 * @property \Foris\Easy\HttpClient\HttpClient $http_client
 */
class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultProviders = [
        ConfigProvider::class,
        CacheProvider::class,
        LoggerProvider::class,
        HttpClientProvider::class,
    ];

    /**
     * ServiceContainer constructor.
     *
     * @param array $config
     * @param array $values
     */
    public function __construct(array $config = [], array $values = [])
    {
        parent::__construct($values);

        $this->userConfig = $config;
        $this->registerProviders($this->getProviders());
    }

    /**
     * Get config
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->userConfig;
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    /**
     * Rebind container service
     *
     * @param string $id
     * @param mixed $value
     * @return $this
     */
    public function rebind(string $id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);
        return $this;
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    protected function getProviders()
    {
        return array_merge($this->defaultProviders, $this->providers);
    }

    /**
     * Register all providers
     *
     * @param array $providers
     */
    protected function registerProviders(array $providers = [])
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }
}