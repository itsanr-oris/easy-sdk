<?php

namespace Foris\Easy\Sdk\Skeleton\Tests;

use Foris\Easy\Sdk\Skeleton\Application;

/**
 * Class TestCase
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Set up test environment
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->app = new Application();
    }

    /**
     * Gets application instance
     *
     * @return Application
     */
    protected function app()
    {
        return $this->app;
    }
}
