<?php

namespace TomatoPHP\FilamentIcons\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $icon,
        public string $size = 'w-6 h-6',
        public ?string $style = null,
    )
    {
    }

    public function render()
    {
        return view('filament-icons::components.icon');
    }
}
