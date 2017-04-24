<?php

/**
 * App\Models\User => ./App/Models/User.php
 */

spl_autoload_register(function ($className)
{
	$file = __DIR__ . '/' .str_replace('\\', '/', $className) . '.php';
	if (file_exists($file)){
    	require $file;
    } else {
    	return false;
    }
});
require __DIR__ . '/vendor/autoload.php';