<?php

namespace TomatoPHP\FilamentIcons;

use Illuminate\Support\ServiceProvider;


class FilamentIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Register generate command
        $this->commands([
           \TomatoPHP\FilamentIcons\Console\FilamentIconsInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/filament-icons.php', 'filament-icons');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/filament-icons.php' => config_path('filament-icons.php'),
        ], 'filament-icons-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'filament-icons-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-icons');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/filament-icons'),
        ], 'filament-icons-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'filament-icons');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => base_path('lang/vendor/filament-icons'),
        ], 'filament-icons-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
