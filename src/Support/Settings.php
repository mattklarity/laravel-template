<?php

namespace Klarity\LibremsTest\Support;

use App\Models\User;
use LibreNMS\Interfaces\Plugins\Hooks\SettingsHook as BaseSettingsHook;

class Settings extends BaseSettingsHook
{
    // Render this blade when user clicks “Settings” under your plugin
    public string $view = 'librems-test::settings';

    // Control who can see/save settings
    public function authorize(User $user): bool
    {
        return $user->can('admin');
    }

    // Inject data into the view. $settings contains persisted values for your plugin.
    public function data(array $settings = []): array
    {
        return [
            'settings' => $settings,
            'version' => config('librems.version', 'dev'),
            'example' => 'Hello from Settings::data()',
        ];
    }
}
