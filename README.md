# This is Solid principle package for beverly

[![Latest Version on Packagist](https://img.shields.io/packagist/v/xbigdaddyx/beverly-solid.svg?style=flat-square)](https://packagist.org/packages/xbigdaddyx/beverly-solid)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/xbigdaddyx/beverly-solid/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/xbigdaddyx/beverly-solid/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/xbigdaddyx/beverly-solid/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/xbigdaddyx/beverly-solid/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/xbigdaddyx/beverly-solid.svg?style=flat-square)](https://packagist.org/packages/xbigdaddyx/beverly-solid)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require xbigdaddyx/beverly-solid
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="beverly-solid-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="beverly-solid-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="beverly-solid-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$beverlySolid = new Xbigdaddyx\BeverlySolid();
echo $beverlySolid->echoPhrase('Hello, Xbigdaddyx!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [xbigdaddyx](https://github.com/xbigdaddyx)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
