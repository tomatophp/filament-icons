<?php

namespace TomatoPHP\FilamentIcons\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \TomatoPHP\FilamentIcons\Services\FilamentIconsServices register(string $id)
 * @method static \TomatoPHP\FilamentIcons\Services\FilamentIconsServices asset(string $path, string $type='css')
 * @method static \TomatoPHP\FilamentIcons\Services\FilamentIconsServices icons(array $icons)
 * @method static \TomatoPHP\FilamentIcons\Services\FilamentIconsServices template()
 * @method static void save()
 * @method static array load()
 */
class FilamentIcons extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filament-icons';
    }
}