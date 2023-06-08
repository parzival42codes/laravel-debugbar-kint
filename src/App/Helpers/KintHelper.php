<?php

use parzival42codes\LaravelKint\App\Services\KintDumpService;

if (! function_exists('kd')) {
    function kd(): KintDumpService
    {
        return new KintDumpService;
    }
}
