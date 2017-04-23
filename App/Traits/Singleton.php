<?php

namespace App\Traits;

trait Singleton
{
    protected static $instance;
    protected function __construct()
    {
    }
    public static function instance($args = NULL)
    {
        if (null === static::$instance) {
            static::$instance = new static($args);
        }
        return static::$instance;
    }
}