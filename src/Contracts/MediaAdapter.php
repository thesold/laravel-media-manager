<?php

namespace Thesold\LaravelMediaManager\Contracts;

interface MediaAdapter
{
    /**
     * Initialise a media library adapter with credentials or essential configuration options
     *
     * @param array $params
     * @return void
     */
    public function config(array $params);
}
