<?php

use Illuminate\Support\Facades\Artisan;

it('check install command', function () {
    Artisan::call('filament-icons:install');

    $schema = \Illuminate\Support\Facades\Cache::has('icons');

    expect($schema)->toBeTrue();
});
