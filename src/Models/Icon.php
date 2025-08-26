<?php

namespace TomatoPHP\FilamentIcons\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $schema = [
        'label' => 'string',
        'name' => 'string',
        'provider' => 'string',
        'template' => 'string',
        'template_class' => 'string',
    ];

    protected $table = 'icons';

    public function getRows() {}

    protected function sushiShouldCache()
    {
        return config('filament-icons.cache', true);
    }
}
