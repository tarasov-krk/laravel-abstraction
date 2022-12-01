<?php

namespace TarasovKrk\LaravelAbstraction;

use Illuminate\Support\ServiceProvider;

class LaravelAbstractionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/modules.php' => config_path('modules.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modules.php', 'modules');
    }
}
