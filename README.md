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

### Default (File) driver

The default driver uses the Intervention Image library to perform basic resizing and cropping. You can customise the image and upload folders.

```sh
# .env

LARAVELMEDIAMANAGER_DRIVER=default
LARAVELMEDIAMANAGER_FOLDER=media # The folder inside the public path where resized images are stored
LARAVELMEDIAMANAGER_UPLOAD_FOLDER=mediamanager # The upload folder within the storage directory where original images (uploads) are stored. These are not publicly accessible
```

### Cloudinary driver

Cloudinary is a cloud based media library offering excellent image optimisation and resizing including facial recognition and focal point cropping. A free cloudinary account is required to use this driver.

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
