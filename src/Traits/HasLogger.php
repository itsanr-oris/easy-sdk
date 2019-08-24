<?php

namespace Foris\Easy\Sdk\Traits;

use Foris\Easy\Logger\Driver\Factory;
use Foris\Easy\Logger\Logger;
use Foris\Easy\Sdk\ServiceContainer;

/**
 * Trait HasLogger
 */
trait HasLogger
{
    /**
     * Get logger instance
     *
     * @return Logger
     * @throws \Foris\Easy\Logger\Exception\InvalidConfigException
     */
    public function logger()
    {
        if (method_exists($this, 'app')) {
            $app = $this->app();
            if (!empty($app) && $app instanceof ServiceContainer && isset($app['logger'])) {
                return $app['logger'];
            }
        }

        return new Logger(new Factory());
    }
}