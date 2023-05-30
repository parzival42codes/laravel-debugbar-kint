<?php

use parzival42codes\LaravelKint\App\Services\KintDumpService;
use parzival42codes\LaravelKint\App\Services\KintService;

if (! function_exists('kd')) {
    /** @phpstan-ignore-next-line */
    function kd(): KintDumpService
    {
        return new KintDumpService();
    }
}
