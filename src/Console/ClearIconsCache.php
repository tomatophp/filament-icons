<?php

namespace TomatoPHP\FilamentIcons\Console;

use Illuminate\Console\Command;
use TomatoPHP\FilamentIcons\Facades\FilamentIcons;

class ClearIconsCache extends Command
{
    public $signature = 'filament-icons:clear-cache';

    public $description = 'Clear the icons cache';

    public function handle()
    {
        $this->info('Clearing icons cache...');
        FilamentIcons::clearCache();
        FilamentIcons::getIcons();
        $this->info('Icons cache cleared!');
    }
}
