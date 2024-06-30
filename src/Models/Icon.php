<?php

namespace TomatoPHP\FilamentIcons\Models;

use BladeUI\Icons\Factory as IconFactory;
use Filament\Facades\Filament;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Sushi\Sushi;
use TomatoPHP\FilamentIcons\Facades\FilamentIcons;

class Icon extends Model
{
    use Sushi;

    protected $schema = [
        'label' => 'string',
        'name' => 'string',
        'provider' => 'string',
        'template' => 'string',
        'template_class' => 'string'
    ];

    public function getRows()
    {
        $iconsCollections = [];
        $iconsFactory = App::make(IconFactory::class);
        $sets = collect($iconsFactory->all());
        foreach ($sets as $key=>$iconGroup){
            $getPathes = $iconGroup['paths'];
            foreach ($getPathes as $path){
                $icons = File::files($path);
                foreach ($icons as $icon) {
                    $getSVGContent = File::get($icon->getRealPath());
                    $iconsArray = [];

                    $iconsArray['label'] = '
                <div class="flex justify-start items-center gap-2">
                    <div class="w-10 h-10 p-2 border border-gary-200 dark:border-gray-700 rounded-lg flex justify-center items-center">
                        '.$getSVGContent.'
                    </div>
                    <div class="flex flex-col gap-1">
                        <h1>'.str($icon->getFileName())
                            ->replace('.svg', '')
                            ->replaceFirst('c-','')
                            ->replaceFirst('o-','')
                            ->replaceFirst('s-','')
                            ->replace('-',' ')
                            ->title().'</h1>
                        <p class="text-gray-600 dark:text-gray-400">'.$iconGroup['prefix'].'-'.str($icon->getFileName())->replace('.svg', '').'</p>
                    </div>
                </div>
            ';
                    $iconsArray['name'] = $iconGroup['prefix'].'-'.str($icon->getFileName())->replace('.svg', '');
                    $iconsArray['provider'] = $iconGroup['prefix'];
                    $iconsArray['template'] = null;
                    $iconsArray['template_class'] = null;
                    $iconsCollections[] = $iconsArray;
                }
            }
        }

        $loadCustomIcons = FilamentIcons::load();

        foreach ($loadCustomIcons as $item){
            foreach ($item['icons'] as $getIcon){
                $iconsArray = [];
                $handelReplaceTemplate = [];
                $name = str($getIcon);
                foreach ($item['replace'] as $replaceArray) {
                    $name = $name->replace($replaceArray, '');
                }
                $name = $name->replace('-',' ')->title()->toString();
                $iconsArray['label'] = '
                    <div class="flex justify-start items-center gap-2">
                        <div class="w-10 h-10 p-2 border border-gary-200 dark:border-gray-700 rounded-lg flex justify-center items-center">
                            '.Str::of($item['template'])->replace('{ ICON }', $getIcon . ' ' . $item['pickerClass'])->toString().'
                        </div>
                        <div class="flex flex-col gap-1">
                            <h1>'.$name.'</h1>
                            <p class="text-gray-600 dark:text-gray-400">'.$getIcon.'</p>
                        </div>
                    </div>
                ';
                $iconsArray['name'] = $getIcon;
                $iconsArray['provider'] = $item['id'];
                $iconsArray['template'] = $item['template'];
                $iconsArray['template_class'] = $item['templateClass'];
                $iconsCollections[] = $iconsArray;
            }
        }

        return $iconsCollections;
    }

    protected function sushiShouldCache()
    {
        return config('filament-icons.cache', true);
    }
}
