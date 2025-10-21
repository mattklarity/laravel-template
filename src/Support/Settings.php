<?php

namespace Klarity\LibremsTest\Support;

use LibreNMS\Interfaces\Plugins\Hooks\SettingsHook;

class Settings implements SettingsHook
{
    public string $view = 'librems-test::settings';

    public function view(): string
    {
        return $this->view;
    }

    // ⬇️ remove the App\Models\User typehint (and be defensive)
    public function authorize($user = null): bool
    {
        return is_object($user) && method_exists($user, 'can')
            ? $user->can('admin')
            : true; // allow if no user was passed
    }

    public function data(array $settings = []): array
    {
        return ['settings' => $settings];
    }
}
