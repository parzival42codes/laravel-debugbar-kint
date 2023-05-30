<?php

use parzival42codes\LaravelKint\App\Services\KintDumpService;
use parzival42codes\LaravelKint\App\Services\KintService;

if (! function_exists('kd')) {
    /** @phpstan-ignore-next-line */
    function kd($dump): void
    {
        Kint::$return = true;
        KintService::addKint(Kint::dump($dump));
        Kint::$return = false;
    }
}

if (! function_exists('kDump')) {
    /** @phpstan-ignore-next-line */
    function kDump(): KintDumpService
    {
        return new KintDumpService();
    }
}
