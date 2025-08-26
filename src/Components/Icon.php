<?php

namespace TomatoPHP\FilamentIcons\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $icon,
        public ?string $class = null,
        public ?string $style = 'display: flex; align-items: center; justify-content: center; width: 20px; height: 20px;',
    ) {}

    public function render()
    {
        return view('filament-icons::components.icon', [
            'icon' => $this->icon,
            'class' => $this->class,
            'style' => $this->style,
        ]);
    }
}
