<?php

namespace Foris\Easy\Sdk\Skeleton\Tests\Hello;

use Foris\Easy\Sdk\Skeleton\Hello\Hello;
use Foris\Easy\Sdk\Skeleton\Tests\TestCase;

/**
 * Class HelloComponentTest
 */
class HelloComponentTest extends TestCase
{
    /**
     * Test get a hello message from hello component.
     */
    public function testGetAHelloMessageFromHelloComponent()
    {
        $this->assertEquals('Hello, easy sdk framework.', $this->app()->get(Hello::name())->hello());
    }
}
