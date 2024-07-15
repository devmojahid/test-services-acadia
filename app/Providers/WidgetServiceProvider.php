<?php

namespace App\Providers;

use App\Pagebuilder\Widgets\ImageWidget;
use App\Pagebuilder\Widgets\TextWidget;
use App\Pagebuilder\Widgets\VideoWidget;
use App\Pagebuilder\Widgets\WidgetRegistry;
use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        WidgetRegistry::register(new TextWidget());
        WidgetRegistry::register(new ImageWidget());
        WidgetRegistry::register(new VideoWidget());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
