<?php

namespace Thesold\LaravelMediaManager\Adapters;

use Thesold\LaravelMediaManager\Contracts\MediaAdapter;

class CloudinaryMediaAdapter implements MediaAdapter
{
    public function config(array $params)
    {
        \Cloudinary::config($params);
    }
}
