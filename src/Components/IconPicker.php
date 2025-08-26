<?php

namespace TomatoPHP\FilamentIcons\Components;

use Filament\Forms\Components\Select;
use TomatoPHP\FilamentIcons\Facades\FilamentIcons;

class IconPicker extends Select
{
    protected function setUp(): void
    {
        $icons = collect(FilamentIcons::getIcons());
        parent::setUp();

        $this->searchable();

        $this->options(fn () => $icons->whereNotNull('label')->pluck('label', 'name')->toArray());

        $this->native(false);

        $this->getSearchResultsUsing(function (string $search) use ($icons): array {

            if (empty($search)) {
                return $icons->filter(fn ($icon) => str($icon['name'])->contains($search))
                    ->pluck('label', 'name')
                    ->toArray();
            }

            return $icons->filter(fn ($icon) => str($icon['name'])->contains($search))
                ->whereNotNull('label')
                ->pluck('label', 'name')
                ->toArray();
        });

        $this->getOptionLabelUsing(fn ($state) => $icons->filter(fn ($icon) => str($icon['name'])->contains($state))->first()['label']);

        $this->label(trans('filament-icons::messages.icon'));
        $this->searchLabels(trans('filament-icons::messages.search'));
        $this->searchingMessage(trans('filament-icons::messages.searching'));

        $this->allowHtml();
    }
}
