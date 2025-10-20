<?php

namespace Klarity\LibremsTest;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Klarity\LibremsTest\Commands\LibremsTestCommand;

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
}
