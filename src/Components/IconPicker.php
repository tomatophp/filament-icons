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

        $this->options(fn () => Icon::query()
            ->limit(20)
            ->pluck('label', 'name')
            ->toArray()
        );


        $this->native(false);

        $this->getSearchResultsUsing(function (string $search): array {

            if (empty($search)) {
                return Icon::query()
                    ->limit(50)
                    ->pluck('label', 'name')
                    ->toArray();
            }

            return Icon::query()
                ->where('name', 'like', "%{$search}%")
                ->limit(50)
                ->pluck('label', 'name')
                ->toArray();
        });


        $this->getOptionLabelUsing(fn ($state) => Icon::firstWhere('name', '=', $state)?->label);

        $this->label(trans('filament-icons::messages.icon'));
        $this->searchLabels(trans('filament-icons::messages.search'));
        $this->searchingMessage(trans('filament-icons::messages.searching'));

        $this->allowHtml();
    }
}
