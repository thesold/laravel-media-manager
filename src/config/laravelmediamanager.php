<?php

return [
    "driver" => env("LARAVELMEDIAMANAGER_DRIVER", "cloudinary"),
    "cloud_name" => env('LARAVELMEDIAMANAGER_CLOUD_NAME'),
    "api_key" => env('LARAVELMEDIAMANAGER_API_KEY'),
    "api_secret" => env('LARAVELMEDIAMANAGER_API_SECRET'),
    "default_folder" => env('LARAVELMEDIAMANAGER_FOLDER', 'media'),
    "upload_folder" => env('LARAVELMEDIAMANAGER_UPLOAD_FOLDER', 'public/mediamanager'),
];
