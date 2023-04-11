<?php

namespace parzival42codes\LaravelDebugbarKint;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\ServiceProvider;
use parzival42codes\LaravelDebugbarKint\App\Debugbar\DataCollector\KintCollector;

class KintServiceProvider extends ServiceProvider
{
    public function register()
    {
        Debugbar::addCollector(new KintCollector());
    }
}
