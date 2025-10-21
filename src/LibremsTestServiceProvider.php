<?php

namespace Klarity\LibremsTest;

use Klarity\LibremsTest\Commands\LibremsTestCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LibremsTestServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {

        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('librems-test')
            ->hasConfigFile('librems')
            ->hasViews()
            ->hasMigration('create_librems_test_table')
            ->hasCommand(LibremsTestCommand::class);
    }

    protected function registeringPackage(): void
    {
        $this->app->singleton(AuditHelper::class, fn () => new AuditHelper);
    }
}
