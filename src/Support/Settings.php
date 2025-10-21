<?php

namespace Klarity\LibremsTest\Support;

use App\Models\User;
use LibreNMS\Interfaces\Plugins\SettingsHook;

class Settings implements SettingsHook
{
    // The Blade view to render for your settings UI
    public function view(): string
    {
        return 'librems-test::settings';
    }

    // Who can see/save settings
    public function authorize(User $user): bool
    {
        return $user->can('admin');
    }

    // Extra data to pass into the view
    public function data(array $settings = []): array
    {
        return ['settings' => $settings];
    }
}
