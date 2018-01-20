<?php

namespace App\Contracts;

interface MediaAdapter
{
    /**
     * Initialise a media library adapter with credentials or essential configuration options
     *
     * @param array $params
     * @return void
     */
    public static function config(array $params);
}
