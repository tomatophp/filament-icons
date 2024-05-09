<?php

namespace TomatoPHP\FilamentIcons;

use Illuminate\Support\ServiceProvider;


class FilamentIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-icons');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-icons'),
        ], 'filament-icons-views');
    }

    public function boot(): void
    {
        //you boot methods here
    }
}
