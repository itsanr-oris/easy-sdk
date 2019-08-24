<?php

namespace Foris\Easy\Sdk;

use Foris\Easy\Sdk\Traits\HasCache;
use Foris\Easy\Sdk\Traits\HasHttpClient;
use Foris\Easy\Sdk\Traits\HasLogger;

/**
 * Class Component
 */
class Component
{
    use HasLogger, HasHttpClient, HasCache;

    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * Component constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * Get serviceContainer instance
     *
     * @return ServiceContainer
     */
    public function app() : ServiceContainer
    {
        return $this->app;
    }
}