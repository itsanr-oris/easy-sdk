<?php

namespace Foris\Easy\Sdk\Skeleton\Tests;

use Foris\Easy\Sdk\Skeleton\Application;
use Foris\Easy\Sdk\Skeleton\Console\Application as Artisan;
use org\bovigo\vfs\vfsStream;

/**
 * Class TestCase
 */
class TestCase extends \Foris\Easy\Sdk\Test\TestCase
{
    /**
     * vfs instance.
     *
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfs;

    /**
     * Tear down the test environment.
     */
    protected function tearDown()
    {
        $this->vfs = null;
        parent::tearDown();
    }

    /**
     * Create sdk application instance.
     *
     * @return \Foris\Easy\Sdk\Application
     */
    protected function createApplication()
    {
        $app = new Application(require __DIR__ . '/../config.example.php');
        $app->setRootPath($this->vfs()->url());
        return $app;
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

    /**
     * Gets the vfs instance.
     *
     * @return \org\bovigo\vfs\vfsStreamDirectory
     */
    protected function vfs()
    {
        if (empty($this->vfs)) {
            $this->vfs = vfsStream::setup('demo-sdk');
            file_put_contents($this->vfs->url() . '/composer.json', file_get_contents(__DIR__ . '/../composer.json'));
        }

        return $this->vfs;
    }
}
