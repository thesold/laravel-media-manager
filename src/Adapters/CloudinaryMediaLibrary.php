<?php

namespace Thesold\LaravelMediaManager\Adapters;

use Thesold\LaravelMediaManager\Contracts\MediaLibrary;

class CloudinaryMediaLibrary implements MediaLibrary
{
    protected $api;

    public function __construct()
    {
        $this->api = new \Cloudinary\Api();
    }

    public function delete($files, array $options = [])
    {
        $filesToDelete = $files;

        if (!is_array($filesToDelete)) {
            $filesToDelete = [$filesToDelete];
        }
        return $this->api->delete_resources($filesToDelete);
    }

    public function resources(String $type = null)
    {
        return $this->api->resources([
            'resource_type' => $type ? : 'image',
            'max_results' => 100,
        ]);
    }

    public function upload(String $file, array $options = [])
    {
        return \Cloudinary\Uploader::Upload($file, $options);
    }

    public function url(String $file, array $options = [])
    {
        return cloudinary_url($file['public_id'], $options);
    }
}
