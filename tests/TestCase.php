<?php

namespace Klarity\LibremsTest\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Klarity\LibremsTest\LibremsTestServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Klarity\\LibremsTest\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LibremsTestServiceProvider::class,
        ];
    }

	public function getEnvironmentSetUp($app)
	{
	    // default connection used by the app
	    $app['config']->set('database.default', 'testing');

	    // define the 'testing' connection (sqlite in-memory)
	    $app['config']->set('database.connections.testing', [
		'driver'   => 'sqlite',
		'database' => ':memory:',
		'prefix'   => '',
	    ]);

	    // if your package reads a custom connection from config('librems.connection'):
	    $app['config']->set('librems.connection', 'testing');

	    // if your package has its own config defaults and you need to override one for tests:
	    // $app['config']->set('librems.features.audit.enabled', true);
	}

	protected function defineDatabaseMigrations()
	{
	    // Point to your package’s migrations folder
	    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

	    // Or, if your ServiceProvider calls loadMigrationsFrom() already,
	    // you can instead run Laravel’s default migrations here if you need them:
	    // $this->loadLaravelMigrations();
	}


}
