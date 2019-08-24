<?php
/**
 * Created by PhpStorm.
 * User: f-oris
 * Date: 2019/8/23
 * Time: 3:45 PM
 */

namespace Foris\Easy\Sdk\Tests\Traits;

use Mockery;
use PHPUnit\Framework\TestCase;
use Foris\Easy\Cache\Cache;
use Foris\Easy\Sdk\Component;
use Foris\Easy\Sdk\ServiceContainer;
use Foris\Easy\Sdk\Traits\HasCache;

/**
 * Class HasCacheTest
 * @package Foris\Easy\Sdk\Tests\Traits
 * @author  f-oris <us@f-oris.me>
 * @version 1.0.0
 */
class HasCacheTest extends TestCase
{
    /**
     * @throws \Foris\Easy\Cache\InvalidConfigException
     * @throws \Foris\Easy\Cache\RuntimeException
     */
    public function testGetCache()
    {
        $mock = Mockery::mock(HasCache::class);
        $this->assertInstanceOf(Cache::class, $mock->cache());
    }

    /**
     * @throws \Foris\Easy\Cache\InvalidConfigException
     * @throws \Foris\Easy\Cache\RuntimeException
     */
    public function testGetCacheFromServiceContainer()
    {
        $cache = Mockery::mock(Cache::class);
        $container = Mockery::mock(ServiceContainer::class);
        $container->shouldReceive('offsetExists')->withArgs(['cache'])->andReturnTrue();
        $container->shouldReceive('offSetGet')->withArgs(['cache'])->andReturn($cache);

        $component = new Component($container);

        $this->assertInstanceOf(Cache::class, $component->cache());
    }
}