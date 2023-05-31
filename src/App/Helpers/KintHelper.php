<?php

use parzival42codes\LaravelKint\App\Services\KintDumpService;

if (! function_exists('kd')) {
    /** @phpstan-ignore-next-line */
    function kd(): KintDumpService
    {
        return new KintDumpService();
    }
}
