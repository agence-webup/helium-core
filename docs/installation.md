# Installation

*Note: please be aware that all shell commands should be customized for your environment.
If you're using laravel/sail, you should be prefixing all commands with `sail `.*

## Requirements

This package requires Vite and tailwindcss be installed in your laravel project.

Vite comes with any new Laravel installation. You can find out how to install tailwind for Laravel
[here](https://tailwindcss.com/docs/guides/laravel).

It also requires you to use Livewire ^v3. It requires Alpinejs, which is bundled with Livewire.
You can find out how to install Livewire [here](https://livewire.laravel.com/docs/installation).

*Note: you can use any other bundler in place of Vite, but it's the only supported one by Helium
since it's the default for any new Laravel project.*

## Install steps

### Adding helium-core to your dependencies

```sh
composer require webup/helium-core
# or, if you live on the edge:
composer require webup/helium-core:@dev
```

### Publishing and customizing the default configuration

`config/helium-core.php` is published along with all the other assets.

You should check to see if the default values suit your requirements.
Most likely, the `user` keyword is already used as your main authentication label.

Helium allows you to change the database table names, along with the name
of the guard and auth provider that will be automatically declared

```sh
# publish the configuration first
artisan vendor:publish --tag=helium-core-config

# /!\ now is the time to configure the package /!\
nano config/helium-core.php

# publish all needed files
artisan vendor:publish --tag=helium-core
```

### Setting up the frontend assets build

In order to unlock the full power of tailwind and helium's customizability,
the package publishes its frontend assets to your application.

The frontend assets are published to:
- `resources/js/vendor/helium-core/`
- `resources/css/vendor/helium-core/`

You can now update your `vite.config.js` to build the new js/css files:
```js
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                // add the helium assets to the build
                'resources/css/vendor/helium-core/app.css',
                'resources/js/vendor/helium-core/app.js',
            ],
            refresh: true,
        }),
    ],
});
```

### Running the migrations

The default helium user has the following credentials: `user@helium.dev; password`.
Should you wish to change that, you can update the `$credentials` array in the
published `helium_create_default_user` migration.

You can then run all the published migrations:
```sh
artisan migrate
```
