<?php

namespace TomatoPHP\FilamentIcons\Services;

use BladeUI\Icons\Factory as IconFactory;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class FilamentIconsServices
{
    private array $icons = [];

    private array $iconsList = [];

    private string $id;

    private string $template;

    private array $replace = [];

    private ?string $pickerClass = null;

    private ?string $templateClass = null;

    /**
     * @return $this
     */
    public function register(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return $this
     */
    public function asset(string $path, string $type = 'css'): static
    {
        if ($type === 'css') {
            FilamentAsset::register([
                Css::make($this->id, $path),
            ]);
        } elseif ($type === 'js') {
            FilamentAsset::register([
                Js::make($this->id, $path),
            ]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function icons(array $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    /**
     * @return $this
     */
    public function pickerClass(string $pickerClass): static
    {
        $this->pickerClass = $pickerClass;

        return $this;
    }

    /**
     * @return $this
     */
    public function templateClass(string $templateClass): static
    {
        $this->templateClass = $templateClass;

        return $this;
    }

    /**
     * @return $this
     */
    public function replace(array $replace): static
    {
        $this->replace = $replace;

        return $this;
    }

    /**
     * @return $this
     */
    public function template(string $template, ?string $templateClass = null, ?string $pickerClass = null): static
    {
        $this->template = $template;
        $this->templateClass = $templateClass;
        $this->pickerClass = $pickerClass;

        return $this;
    }

    public function save(): void
    {
        $this->iconsList[] = [
            'id' => $this->id,
            'icons' => $this->icons,
            'template' => $this->template,
            'replace' => $this->replace,
            'pickerClass' => $this->pickerClass,
            'templateClass' => $this->templateClass,
        ];
    }

    public function load(): array
    {
        return $this->iconsList;
    }

    public function getIcons(): array
    {
        if (Cache::has('icons')) {
            return Cache::get('icons');
        }

        $iconsCollections = [];
        $iconsFactory = App::make(IconFactory::class);
        $sets = collect($iconsFactory->all());
        foreach ($sets as $key => $iconGroup) {
            $getPathes = $iconGroup['paths'];
            foreach ($getPathes as $path) {
                $icons = File::files($path);
                foreach ($icons as $icon) {
                    $getSVGContent = File::get($icon->getRealPath());
                    $iconsArray = [];

                    $iconsArray['label'] = view('filament-icons::components.icon-item', [
                        'getSVGContent' => $getSVGContent,
                        'icon' => $icon,
                        'iconGroup' => $iconGroup,
                        'provider' => $iconGroup['prefix'],
                    ])->render();
                    $iconsArray['name'] = $iconGroup['prefix'] . '-' . str($icon->getFileName())->replace('.svg', '');
                    $iconsArray['provider'] = $iconGroup['prefix'];
                    $iconsArray['template'] = null;
                    $iconsArray['template_class'] = null;
                    $iconsCollections[] = $iconsArray;
                }
            }
        }

        $loadCustomIcons = self::load();

        foreach ($loadCustomIcons as $item) {
            foreach ($item['icons'] as $getIcon) {
                $iconsArray = [];
                $handelReplaceTemplate = [];
                $name = str($getIcon);
                foreach ($item['replace'] as $replaceArray) {
                    $name = $name->replace($replaceArray, '');
                }
                $name = $name->replace('-', ' ')->title()->toString();
                $iconsArray['label'] = view('filament-icons::components.icon-custom-item', [
                    'getIcon' => $getIcon,
                    'name' => $name,
                    'item' => $item,
                    'replace' => $replaceArray,
                ])->render();
                $iconsArray['name'] = $getIcon;
                $iconsArray['provider'] = $item['id'];
                $iconsArray['template'] = $item['template'];
                $iconsArray['template_class'] = $item['templateClass'];
                $iconsCollections[] = $iconsArray;
            }
        }

        return Cache::remember('icons', 60, fn () => $iconsCollections);
    }

    public function getIcon(string $name): array
    {
        return collect(self::getIcons())->firstWhere('name', $name);
    }

    /**
     * @return null
     */
    public function clearCache(): void
    {
        Cache::forget('icons');
    }
}
