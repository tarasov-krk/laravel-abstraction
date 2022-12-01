<?php

namespace TarasovKrk\LaravelAbstraction;

use Illuminate\Support\ServiceProvider;

class LaravelAbstractionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            $configPath => config_path('modules.php'),
        ], 'config');
    }
}
