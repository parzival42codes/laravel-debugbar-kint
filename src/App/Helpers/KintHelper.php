<?php

use parzival42codes\LaravelDebugbarKint\App\Services\KintService;

if (! function_exists('kd')) {
    /** @phpstan-ignore-next-line */
    function kd($dump): void
    {
        Kint::$return = true;
        KintService::addKint(Kint::dump($dump));
        Kint::$return = false;
    }
}
