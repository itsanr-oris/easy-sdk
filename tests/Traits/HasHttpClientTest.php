<?php
/**
 * Created by PhpStorm.
 * User: f-oris
 * Date: 2019/8/23
 * Time: 3:48 PM
 */

namespace Foris\Easy\Sdk\Tests\Traits;

use Mockery;
use PHPUnit\Framework\TestCase;
use Foris\Easy\HttpClient\HttpClient;
use Foris\Easy\Sdk\Component;
use Foris\Easy\Sdk\ServiceContainer;
use Foris\Easy\Sdk\Traits\HasHttpClient;

/**
 * Class HasHttpClientTest
 * @package Foris\Easy\Sdk\Tests\Traits
 * @author  f-oris <us@f-oris.me>
 * @version 1.0.0
 */
class HasHttpClientTest extends TestCase
{
    /**
     * test get http client
     */
    public function testGetHttpClient()
    {
        $mock = Mockery::mock(HasHttpClient::class);
        $this->assertInstanceOf(HttpClient::class, $mock->http());
    }

    /**
     * test get http client from service container
     */
    public function testGetHttpClientFromServiceContainer()
    {
        $client = Mockery::mock(HttpClient::class);
        $container = Mockery::mock(ServiceContainer::class);
        $container->shouldReceive('offsetExists')->withArgs(['http_client'])->andReturnTrue();
        $container->shouldReceive('offSetGet')->withArgs(['http_client'])->andReturn($client);

        $component = new Component($container);

        $this->assertInstanceOf(HttpClient::class, $component->http());
    }
}