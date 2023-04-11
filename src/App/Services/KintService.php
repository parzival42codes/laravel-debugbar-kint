<?php

namespace parzival42codes\LaravelDebugbarKint\App\Services;

class KintService
{
    protected static array $container = [];

    // @phpstan-ignore-next-line
    public static function addKint($kint): void
    {
        self::$container[] = $kint;
    }

    public static function getKint(): array
    {
        return self::$container;
    }
}
