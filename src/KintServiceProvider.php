<?php

namespace parzival42codes\LaravelKint;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\ServiceProvider;
use parzival42codes\LaravelKint\App\Debugbar\DataCollector\KintCollector;

class KintServiceProvider extends ServiceProvider
{
    public function register()
    {
        Debugbar::addCollector(new KintCollector());
    }
}
