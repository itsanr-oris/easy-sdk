<?php

namespace Foris\Easy\Sdk\Skeleton\Console\Commands;

use Foris\Easy\Sdk\Console\Commands\MakeComponentCommand as Command;

/**
 * Class MakeComponentCommand
 */
class MakeComponentCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @return bool
     * @throws \Foris\Easy\Support\Exceptions\FileNotFountException
     * @throws \ReflectionException
     */
    protected function handle()
    {
        if ($result = parent::handle()) {
            system('php artisan ide-helper:meta --ansi');
        }

        return $result;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('alias')) {
            return __DIR__ . '/../Stubs/DummyComponentWithAliasName.stub';
        }

        return __DIR__ . '/../Stubs/DummyComponent.stub';
    }
}
