<?php

namespace Klarity\LibremsTest\Support;

use LibreNMS\Interfaces\Plugins\SettingsHook;

class Settings extends SettingsHook
{
    // Point to your settings blade. Default is 'resources.views.settings' inside the plugin.
    public string $view = 'librems-test::settings';

    // (optional) gate access
    public function authorize(\App\Models\User $user): bool
    {
        return $user->can('admin'); // or whatever you like
    }

    // Inject extra data into the view. $settings = values stored by LibreNMS for your plugin.
    public function data(array $settings = []): array
    {
        return [
            'settings' => $settings,
            'example' => 'Hello from Settings::data()',
        ];
    }
}
