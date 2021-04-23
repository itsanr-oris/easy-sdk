<?php

namespace Foris\Easy\Sdk\Skeleton\Tests;

use Foris\Easy\Sdk\Skeleton\Application;
use Foris\Easy\Sdk\Skeleton\Console\Application as Artisan;

/**
 * Class TestCase
 */
class TestCase extends \Foris\Easy\Sdk\Test\TestCase
{
    /**
     * Create sdk application instance.
     *
     * @return \Foris\Easy\Sdk\Application
     */
    protected function createApplication()
    {
        return new Application();
    }

    /**
     * Create artisan command application instance.
     *
     * @return \Foris\Easy\Sdk\Console\Application|Artisan
     * @throws \ReflectionException
     */
    protected function createArtisan()
    {
        return new Artisan($this->app());
    }
}
