<?php

namespace Klarity\LibremsTest\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Klarity\LibremsTest\LibremsTest
 */
class LibremsTest extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Klarity\LibremsTest\LibremsTest::class;
    }
}
