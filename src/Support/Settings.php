<?php

namespace Klarity\LibremsTest\Support;

use App\Models\User;
// 👇 add Hooks\
use LibreNMS\Interfaces\Plugins\Hooks\SettingsHook;

class Settings implements SettingsHook
{
    public function view(): string
    {
        return 'librems-test::settings';
    }

    public function authorize(User $user): bool
    {
        return $user->can('admin');
    }

    public function data(array $settings = []): array
    {
        return ['settings' => $settings];
    }
}
