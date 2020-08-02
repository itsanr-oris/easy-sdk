<?php

namespace Foris\Easy\Sdk\Skeleton\Console;

/**
 * Class Application
 */
class Application extends \Foris\Easy\Sdk\Console\Application
{
    /**
     * Register the commands for the application.
     *
     * @throws \ReflectionException
     */
    protected function commands()
    {
        parent::commands();
        $this->load(__DIR__ . '/Commands');
    }
}
