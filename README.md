# Laravel Helium Core

Laravel Admin made with Helium UI

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webup/helium-core.svg?style=flat-square)](https://packagist.org/packages/webup/helium-core)
[![tests](https://github.com/agence-webup/helium-core/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/agence-webup/helium-core/actions/workflows/tests.yml)
[![pint](https://github.com/agence-webup/helium-core/actions/workflows/pint.yml/badge.svg?branch=main)](https://github.com/agence-webup/helium-core/actions/workflows/pint.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/webup/helium-core.svg?style=flat-square)](https://packagist.org/packages/webup/helium-core)

## Requirements

```bash
# you also need to follow this package's installation steps
composer require webup/helium-ui
```

## Installation

You can install the package via composer:

```bash
composer require webup/helium-core
```

You can publish features as you go with:

```bash
php artisan helium:publish
```

## :warning: Configuration :warning:

The published config file handles all specific configuration prior to publishing a feature.
Once a feature is published, the only way to update its configurable properties is manual.

Thus, make sure to configure this package to suit your preferences before starting to publish anything.

## Features

### User

```bash
php artisan helium:publish
> User
```

Don't forget to add the guard and provider to `config/auth.php`:
```php
<?php

return [
    ...
    'guards' => [
        ...
        'your_configured_guard_name_here' => [
            'driver' => 'session',
            'provider' => 'helium_users_table_name',
        ],
    ],

    'providers' => [
        ...
        'helium_users_table_name' => [
            'driver' => 'eloquent',
            'model' => App\Models\YourConfiguredNamespace\YourConfiguredClassName::class,
        ],
    ],
];
```

### Datatable

[doc](docs/datatable.md)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Agence Webup](https://github.com/agence-webup)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
