<?php

namespace App\Adapters;

use App\Contracts\MediaAdapter;

class CloudinaryMediaAdapter implements MediaAdapter
{
    public static function config(array $params)
    {
        \Cloudinary::config($params);
    }
}
