<?php
header('Content-Type: text/html; charset=utf-8');
define ('ROOT_DIR', __DIR__ . '/..');

require ROOT_DIR . '/autoload.php';

/*
 * загружаем профиль
 */

if (file_exists(ROOT_DIR . '/Profiles/profile.php')){
    define('PROFILE', require ROOT_DIR . '/Profiles/profile.php');
} else {
    define('PROFILE', 'default');
}

App::instance()->run();
