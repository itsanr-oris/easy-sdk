<?php
/**
 * Created by PhpStorm.
 * User: f-oris
 * Date: 2019/8/23
 * Time: 3:44 PM
 */

namespace Foris\Easy\Sdk\Tests;

use Mockery;
use PHPUnit\Framework\TestCase;
use Foris\Easy\Sdk\Component;
use Foris\Easy\Sdk\ServiceContainer;

/**
 * Class ComponentTest
 * @package Foris\Easy\Sdk\Tests
 * @author  f-oris <us@f-oris.me>
 * @version 1.0.0
 */
class ComponentTest extends TestCase
{
    /**
     * test get application
     */
    public function testGetApplication()
    {
        $application = Mockery::mock(ServiceContainer::class);
        $component = new Component($application);
        $this->assertInstanceOf(ServiceContainer::class, $component->app());
    }
}