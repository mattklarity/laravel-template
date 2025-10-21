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

    public function authorize($user = null): bool
    {
        return true; // TEMP: confirm it's an auth issue
    }

    public function data(array $settings = []): array
    {
        return ['settings' => $settings];
    }
}
