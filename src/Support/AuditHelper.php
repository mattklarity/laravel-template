<?php

namespace Klarity\LibremsTest\Support;

class AuditHelper {
    public function doSomething(int $count): void { /* ... */ }
}

// in your ServiceProvider::register()
public function register(): void
{
    $this->app->singleton(
        \Klarity\LibremsTest\Support\AuditHelper::class,
        fn () => new \Klarity\LibremsTest\Support\AuditHelper()
    );
}


