<?php
/**
 * Created by PhpStorm.
 * User: f-oris
 * Date: 2019/8/23
 * Time: 3:50 PM
 */

namespace Foris\Easy\Sdk\Tests\Traits;

use Foris\Easy\Logger\Logger;
use Foris\Easy\Sdk\Component;
use Foris\Easy\Sdk\ServiceContainer;
use Foris\Easy\Sdk\Traits\HasLogger;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class HasLoggerTest
 * @package Foris\Easy\Sdk\Tests\Traits
 * @author  f-oris <us@f-oris.me>
 * @version 1.0.0
 */
class HasLoggerTest extends TestCase
{
    /**
     * @throws \Foris\Easy\Logger\Exception\InvalidConfigException
     */
    public function testGetLogger()
    {
        $mock = Mockery::mock(HasLogger::class);
        $this->assertInstanceOf(Logger::class, $mock->logger());
    }

    /**
     * @throws \Foris\Easy\Logger\Exception\InvalidConfigException
     */
    public function testGetLoggerFromServiceContainer()
    {
        $client = Mockery::mock(Logger::class);
        $container = Mockery::mock(ServiceContainer::class);
        $container->shouldReceive('offsetExists')->withArgs(['logger'])->andReturnTrue();
        $container->shouldReceive('offSetGet')->withArgs(['logger'])->andReturn($client);

        $component = new Component($container);

        $this->assertInstanceOf(Logger::class, $component->logger());
    }
}