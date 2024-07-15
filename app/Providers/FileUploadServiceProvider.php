<?php

namespace App\Providers;

use App\Supports\FileUploadService;
use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FileUploadService::class, function ($app) {
            return new FileUploadService();
        });

        $this->app->alias(FileUploadService::class, 'file-upload');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
