# Installation

*Note: please be aware that all shell commands should be customizedfor your environment.
If you're using laravel/sail, you should be prefixing all commands with `sail `.*

## Requirements

This package requires that Vite and tailwindcss are installed in your laravel project.

Vite comes with any new Laravel installation. You can find out how to install tailwind for Laravel
[here](https://tailwindcss.com/docs/guides/laravel).

It also requires you to use Livewire ^v3. It requires Alpinejs, which is bundled with Livewire.
You can find out how to install Livewire [here](https://livewire.laravel.com/docs/installation).

## Install steps

### Adding helium-core to your dependencies

```sh
composer require webup/helium-core
# or, if you live on the edge:
composer require webup/helium-core:@dev
```

### Setting up the frontend assets build

In order to unlock the full power of tailwind and helium's customizability,
you need to publish our frontend assets in your application:

```sh
artisan vendor:publish --tag=helium-assets
```

This will create files in the following directories:
- `resources/js/vendor/helium/`
- `resources/css/vendor/helium/`

You can now update your `vite.config.js` to build those new files:
```js
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                // add the helium assets to the build
                'resources/css/vendor/helium/app.css',
                'resources/js/vendor/helium/app.js',
            ],
            refresh: true,
        }),
    ],
});
```
