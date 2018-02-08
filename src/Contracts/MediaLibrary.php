<?php

namespace Thesold\LaravelMediaManager\Contracts;

interface MediaLibrary
{
    public function __construct();

    public function delete($files, array $options = []);

    /**
     * Returns collection of resources for a given media type
     *
     * @param String $type
     * @return Illumiate\Facades\Collection
     */
    public function resources(String $type = null);

    /**
     * Upload a file to the media library
     *
     * @param String $file
     * @param array $options
     * @return array
     */
    public function upload(String $file, array $options = []);
}
