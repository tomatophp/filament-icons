<?php

namespace TomatoPHP\FilamentIcons\Console;

use Illuminate\Console\Command;
use TomatoPHP\FilamentIcons\Facades\FilamentIcons;

class InstallFilamentIcons extends Command
{
    public $signature = 'filament-icons:install';

    public $description = 'cache and collect all icons on the system';

    public function handle()
    {
        $this->info('Loading Icons...');
        FilamentIcons::getIcons();
        $this->info('Icons Has Been Installed And Cached!');
    }
}
