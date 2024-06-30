<?php

namespace TomatoPHP\FilamentIcons\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use TomatoPHP\FilamentIcons\Models\Icon;

class InstallFilamentIcons extends Command
{

    public $signature = 'filament-icons:install';

    public $description = 'cache and collect all icons on the system';

    public function handle()
    {
        $this->info('Loading Icons...');
        Icon::all();
        $this->info('Icons Has Been Installed And Cached!');
    }
}
