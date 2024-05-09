![Screenshot](https://github.com/tomatophp/filament-icons/blob/master/arts/3x1io-tomato-icons.jpg)

# Filament Heroicon Picker

[![Latest Stable Version](https://poser.pugx.org/tomatophp/filament-icons/version.svg)](https://packagist.org/packages/tomatophp/filament-icons)
[![PHP Version Require](http://poser.pugx.org/tomatophp/filament-icons/require/php)](https://packagist.org/packages/tomatophp/filament-icons)
[![License](https://poser.pugx.org/tomatophp/filament-icons/license.svg)](https://packagist.org/packages/tomatophp/filament-icons)
[![Downloads](https://poser.pugx.org/tomatophp/filament-icons/d/total.svg)](https://packagist.org/packages/tomatophp/filament-icons)

Heroicons Picker and Column for FilamentPHP

## Screenshots

![Dark Input](https://github.com/tomatophp/filament-icons/blob/master/arts/input-dark.png)
![Dark Input Select](https://github.com/tomatophp/filament-icons/blob/master/arts/input-select-dark.png)
![Light Input](https://github.com/tomatophp/filament-icons/blob/master/arts/input-light.png)
![Light Input Select](https://github.com/tomatophp/filament-icons/blob/master/arts/input-select-light.png)
![Table Column](https://github.com/tomatophp/filament-icons/blob/master/arts/column.png)

## Installation

```bash
composer require tomatophp/filament-icons
```

## Usage

```php
use TomatoPHP\FilamentIcons\Components\IconPicker;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            IconPicker::make('icon')
                ->default('heroicon-o-academic-cap')
                ->label('Icon'),
        ]);
}
```

```php
use TomatoPHP\FilamentIcons\Components\IconColumn;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            IconColumn::make('icon')
                ->label('Icon'),
        ]);
}
```



## Publish Assets

you can publish views file by use this command

```bash
php artisan vendor:publish --tag="filament-icons-views"
```

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/Xqmt35Uh)

## Docs

you can check docs of this package on [Docs](https://docs.tomatophp.com/plugins/laravel-package-generator)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](mailto:info@3x1.io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
