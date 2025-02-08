<?php

namespace TomatoPHP\FilamentIcons;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\FilamentIcons\Console\ClearIconsCache;
use TomatoPHP\FilamentIcons\Console\InstallFilamentIcons;
use TomatoPHP\FilamentIcons\Services\FilamentIconsServices;


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

        $this->app->bind('filament-icons', function () {
            return new FilamentIconsServices();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/filament-icons.php', 'filament-icons');

        $this->publishes([
            __DIR__.'/../config/filament-icons.php' => config_path('filament-icons.php'),
        ], 'filament-icons-config');

        $this->loadViewComponentsAs('filament', [
            Components\Icon::class,
        ]);

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-icons');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-icons'),
        ], 'filament-icons-lang');

        $this->commands([
            ClearIconsCache::class,
            InstallFilamentIcons::class
        ]);
    }

    public function boot(): void
    {
        //you boot methods here
    }
}
