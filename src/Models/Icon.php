<?php

namespace TomatoPHP\FilamentIcons\Models;

use BladeUI\Icons\Factory as IconFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Sushi\Sushi;

class Icon extends Model
{
    use Sushi;

    protected $schema = [
        'label' => 'string',
        'name' => 'string',
    ];

    public function getRows()
    {
        $iconsFactory = App::make(IconFactory::class);
        $sets = collect($iconsFactory->all());
        $path = $sets['heroicons']['paths'][0];
        $icons = File::files($path);
        $iconsCollections = [];
        foreach ($icons as $icon) {
            $getSVGContent = File::get($icon->getRealPath());
            $iconsArray = [];

            $iconsArray['label'] = '
                <div class="flex justify-start items-center gap-2">
                    <div class="w-12 h-12 p-2 border border-gary-200 dark:border-gray-700 rounded-lg flex justify-center items-center">
                        '.$getSVGContent.'
                    </div>
                    <div class="flex flex-col gap-1">
                        <h1>'.str($icon->getFileName())->replace('.svg', '')->replaceFirst('c-','')->replaceFirst('o-','')->replaceFirst('s-','')->replace('-',' ')->title().'</h1>
                        <p class="text-gray-600 dark:text-gray-400">heroicon-'.str($icon->getFileName())->replace('.svg', '').'</p>
                    </div>
                </div>
            ';
            $iconsArray['name'] = 'heroicon-'.str($icon->getFileName())->replace('.svg', '');
            $iconsCollections[] = $iconsArray;
        }

        return $iconsCollections;
    }

    protected function sushiShouldCache()
    {
        return true;
    }
}
