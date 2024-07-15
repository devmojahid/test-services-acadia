<?php

namespace Plugins\Blogplugin;

use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load plugin routes
        // $this->loadRoutesFrom(__DIR__ . '/src/routes.php');

        // Load plugin views, if any
        // $this->loadViewsFrom(__DIR__ . '/src/Views', 'blogplugin');
    }

    public function register()
    {
        // Register any bindings or configurations here
    }
}
