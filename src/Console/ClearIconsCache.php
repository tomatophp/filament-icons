<?php

namespace TomatoPHP\FilamentIcons\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearIconsCache extends Command
{

    public $signature = 'filament-icons:clear-cache';

    public $description = 'Clear the icons cache';

    public function handle()
    {
        $this->info('Clearing icons cache...');
        $this->call('cache:clear');
        $cachePath = storage_path('framework/cache/sushi-tomato-p-h-p-filament-icons-models-icon.sqlite');
        if(File::exists($cachePath)){
            File::delete($cachePath);
        }
        $this->info('Icons cache cleared!');
    }
}
