<?php

namespace Klarity\LibremsTest;

use Klarity\LibremsTest\Commands\LibremsTestCommand;
use Klarity\LibremsTest\Support\AuditHelper;
use LibreNMS\Interfaces\Plugins\PluginManagerInterface;
use LibreNMS\Interfaces\Plugins\SettingsHook;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LibremsTestServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('librems-test')
            ->hasConfigFile('librems')
            ->hasViews() // loads from resources/views and gives them a package namespace
            ->hasMigration('create_librems_test_table')
            ->hasCommand(LibremsTestCommand::class);
    }

    public function registeringPackage(): void
    {
        // optional helper you referenced
        $this->app->singleton(AuditHelper::class, fn () => new AuditHelper);
    }

    // you can keep boot(), or switch to bootingPackage()/packageBooted()—either works.
    public function boot(): void
    {
        parent::boot(); // keep Spatie’s defaults

        $plugin = 'librems-test'; // must match the slug you enable in LibreNMS → Plugins

        /** @var PluginManagerInterface $pm */
        $pm = $this->app->make(PluginManagerInterface::class);

        // register the Settings hook for this plugin
        $pm->publishHook(
            $plugin,
            SettingsHook::class,
            \Klarity\LibremsTest\Support\Settings::class
        );

        // if disabled, skip the rest
        if (! $pm->pluginEnabled($plugin)) {
            return;
        }

        // give your views a namespace for Blade like: librems-test::settings
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'librems-test');
    }
}

