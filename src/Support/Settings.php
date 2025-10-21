<?php

namespace Klarity\LibremsTest\Support;

// 👇 add Hooks\
use LibreNMS\Interfaces\Plugins\Hooks\SettingsHook;

class Settings implements SettingsHook
{
    public string $view = 'librems-test::settings';

    public function view(): string
    {
        return $this->view;
    }

    public function authorize($user): bool
    {
        return method_exists($user, 'can') ? $user->can('admin') : true;
    }

    public function data(array $settings = []): array
    {
        return ['settings' => $settings];
    }
}
