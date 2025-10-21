<?php

namespace Klarity\LibremsTest;

use Klarity\LibremsTest\Commands\LibremsTestCommand;
use Klarity\LibremsTest\Support\AuditHelper;
use Klarity\LibremsTest\Support\Settings;
use LibreNMS\Interfaces\Plugins\PluginManagerInterface;
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

    public function boot(): void
    {
        parent::boot();

        $plugin = 'librems-test';

        // 1) register the view namespace FIRST
        // (hasViews() already does this too, but calling it explicitly here ensures
        // it's available before the hook is published)
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'librems-test');

        /** @var PluginManagerInterface $pm */
        $pm = $this->app->make(PluginManagerInterface::class);

        // 2) publish the Settings hook using the Hooks\ interface
        $pm->publishHook(
            $plugin,
            \LibreNMS\Interfaces\Plugins\Hooks\SettingsHook::class,
            \Klarity\LibremsTest\Support\Settings::class
        );

        // 3) (optional) if you want to skip further plugin-specific boot when disabled,
        //    do it AFTER the two lines above (so Settings still registers)
        // if (! $pm->pluginEnabled($plugin)) {
        //     return;
        // }
    }
}
