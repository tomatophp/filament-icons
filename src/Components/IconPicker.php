<?php

namespace TomatoPHP\FilamentIcons\Components;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Support\Contracts\HasLabel as LabelInterface;
use Illuminate\Contracts\Support\Arrayable;
use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use TomatoPHP\FilamentIcons\Models\Icon;

class IconPicker extends Select
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->searchable();
        $this->options(Icon::query()->take(10)->pluck('label', 'name')->toArray());
        $this->getSearchResultsUsing(fn (string $search): array => !empty($search) ? Icon::query()->where('name', 'like', "%{$search}%")->pluck('label', 'name')->toArray() : Icon::query()->limit(50)->pluck('label', 'name')->get()->toArray());
        $this->allowHtml();
    }
}
