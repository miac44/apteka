<?php

header('Content-Type: text/html; charset=utf-8');
require __DIR__ . '/autoload.php';


$uri = str_replace(\App\Config::instance()->dir,'',$_SERVER['REQUEST_URI']);
try {
	$route = \App\Router::parseUrl($uri);
} catch (\App\Exceptions\RouteException $e){
	echo "Ошибка роутинга - " . $e->getMessage();
}
$controller = new $route->controller;
$controller->action($route->action);
