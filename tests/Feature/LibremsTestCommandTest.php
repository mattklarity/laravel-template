<?php

use Orchestra\Testbench\TestCase;

class LibremsTestCommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [\Klarity\LibremsTest\Providers\LibremsTestServiceProvider::class];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function test_command_runs()
    {
        $this->artisan('librems-test')->assertExitCode(0);
    }
}
