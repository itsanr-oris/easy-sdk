<?php

namespace Foris\Easy\Sdk\Skeleton\Tests\Logger;

use Foris\Easy\Logger\Logger;
use Foris\Easy\Sdk\Skeleton\Tests\TestCase;

/**
 * Class GetLoggerInstanceTest
 */
class GetLoggerInstanceTest extends TestCase
{
    /**
     * Test get logger instance.
     */
    public function testGetLoggerInstance()
    {
        $this->assertInstanceOf(Logger::class, $this->app()->get('logger'));
    }
}
