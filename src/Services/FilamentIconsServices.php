<?php

namespace TomatoPHP\FilamentIcons\Services;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

class FilamentIconsServices
{
    /**
     * @var array
     */
    private array $icons=[];
    /**
     * @var array
     */
    private array $iconsList=[];
    /**
     * @var string
     */
    private string $id;
    /**
     * @var string
     */
    private string $template;
    private array $replace=[];
    private ?string $pcikerStyle=null;
    private ?string $templateStyle=null;

    /**
     * @param string $id
     * @return $this
     */
    public function register(string $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $path
     * @param string $type
     * @return $this
     */
    public function asset(string $path, string $type='css'): static
    {
        if($type === 'css')
        {
            FilamentAsset::register([
                Css::make($this->id, $path)
            ]);
        }
        else if($type === 'js') {
            FilamentAsset::register([
                Js::make($this->id, $path)
            ]);
        }

        return $this;
    }

    /**
     * @param array $icons
     * @return $this
     */
    public function icons(array $icons): static
    {
        $this->icons = $icons;
        return $this;
    }

    public function replace(array $replace): static
    {
        $this->replace = $replace;
        return $this;
    }

    /**
     * @return $this
     */
    public function template(string $template, ?string $pickerClass=null, ?string $templateClass=null): static
    {
        $this->template = $template;
        $this->pickerClass = $pickerClass;
        $this->templateClass = $templateClass;
        return $this;
    }

    /**
     * @return void
     */
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

    public function pickerClass(string $pickerClass): static
    {
        $this->pickerClass = $pickerClass;
        return $this;
    }

    public function templateClass(string $templateClass): static
    {
        $this->templateClass = $templateClass;
        return $this;
    }

    /**
     * @return array
     */
    public function load(): array
    {
        return $this->iconsList;
    }
}
