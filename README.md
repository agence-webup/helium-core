# Laravel Helium Core

Laravel Admin made with Helium UI

[![Latest Version on Packagist](https://img.shields.io/packagist/v/webup/helium-core.svg?style=flat-square)](https://packagist.org/packages/webup/helium-core)
[![tests](https://github.com/agence-webup/helium-core/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/agence-webup/helium-core/actions/workflows/tests.yml)
[![pint](https://github.com/agence-webup/helium-core/actions/workflows/pint.yml/badge.svg?branch=main)](https://github.com/agence-webup/helium-core/actions/workflows/pint.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/webup/helium-core.svg?style=flat-square)](https://packagist.org/packages/webup/helium-core)

## Installation

You can install the package via composer:

```bash
composer require webup/helium-core
```

You should publish config and components
```bash
sail artisan vendor:publish
```

You can publish features as you go with:

```bash
php artisan helium:publish
```

Publishing a feature will copy paste every file associated with it.
This includes:
- config, controllers, models
- migrations, routes
- js, css
- x-components, livewire components, blade views

## :warning: Configuration :warning:

Make sure to configure this package to suit your preferences before starting to publish anything.

## Features

### Admin User management

This feature packs an AdminUser model along with its migration,
a default `{email: 'admin', password: 'password'}` entry,
and CRUD routes + pages.

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
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin_users',
        ],
    ],

    'providers' => [
        ...
        'admin_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin\AdminUser::class,
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
