# Laravel Media Manager

A Laravel companion package to work with [thesold/vue-media-manager](https://github.com/thesold/vue-media-manager) to provide a ready-made Media Manager interface with back-end.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thesold/laravel-media-manager.svg?style=for-the-badge)](https://packagist.org/packages/thesold/laravel-media-manager)

## Installation

```sh
composer require thesold/laravel-media-manager
```

This package uses auto-loading in Laravel 5.5

For Laravel 5.1 - 5.4 load the Service Provider and Facde.

```php
// config/app.php

'providers' => [
    ...
    Thesold\LaravelMediaManager\MediaServiceProvider::class,
];
```

You are free to publish the `laravelmediamanager.php` config to customise the package, however we recommend using environment variables to specify required settings.

## Drivers

Currently the only available driver is Cloudinary. You will need a free cloudinary account.

```sh
# .env

LARAVELMEDIAMANAGER_DRIVER=cloudinary
LARAVELMEDIAMANAGER_CLOUD_NAME=cloudinary-cloud-name
LARAVELMEDIAMANAGER_API_KEY=cloudinary-api-key
LARAVELMEDIAMANAGER_API_SECRET=cloudinary-api-secret
```

## Usage

The package includes all routes, middleware and controllers to enable the Vue media library. Simply install [thesold/vue-media-manager](https://github.com/thesold/vue-media-manager) and follow the instructions to specify your Laravl Media Manager URL.

## Support

If you require any support please contact me on [Twitter](https://twitter.com/m2de_io) or open an issue on this repository.

## License

GPL-3.0
