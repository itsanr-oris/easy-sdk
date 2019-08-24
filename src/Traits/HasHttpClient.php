<?php

namespace Foris\Easy\Sdk\Traits;

use Foris\Easy\HttpClient\HttpClient;
use Foris\Easy\Sdk\ServiceContainer;

/**
 * Trait HasHttpClient
 */
trait HasHttpClient
{
    /**
     * Get http-client instance.
     *
     * @return HttpClient
     */
    public function http()
    {
        if (method_exists($this, 'app')) {
            $app = $this->app();
            if (!empty($app) && $app instanceof ServiceContainer && isset($app['http_client'])) {
                return $app['http_client'];
            }
        }

        return new HttpClient();
    }
}