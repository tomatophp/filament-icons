<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

it('check install command', function () {
    Artisan::call('filament-icons:install');

    $schema = Cache::has('icons');

    expect($schema)->toBeTrue();
});
