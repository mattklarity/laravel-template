<?php

namespace Klarity\LibremsTest;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Klarity\LibremsTest\Commands\LibremsTestCommand;

class LibremsTestServiceProvider extends PackageServiceProvider
{
    public function boot(): void {

	    if ($this->app->runningInConsole()) {
		$this->commands([
		    \Klarity\LibremsTest\Commands\LibremsTestCommand::class,
		]);

		// If you ship migrations / config:
		$this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
		$this->publishes([__DIR__.'/../../config/librems.php' => config_path('librems.php')], 'config');
	    }

    }

    public function register(): void
    {
	    // lets config('librems.*') work even if user hasn't published the file
	    $this->mergeConfigFrom(__DIR__.'/../../config/librems.php', 'librems');
    }

    public function configurePackage(Package $package): void
    {

        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('librems-test')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_librems_test_table')
            ->hasCommand(LibremsTestCommand::class);
    }
}
