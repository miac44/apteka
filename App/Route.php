<?php

namespace App;

use \App\Exceptions;

class Route 
{

	public $controller;
	public $action;
	public $args;

	function __construct($data)
	{
		$this->controller = '\\Modules\\Controllers\\' . $data['controller'] . '\\Index';
		$this->action = $data['action'];
		$this->args = $data['args'];
	}

	public static function get($url)
	{
		if (!self::getPattern($url)){
			throw new Exceptions\RouteException('Нет роута для такого url - ' . $url);
		};
		$routePattern = self::getPattern($url);
		$routePath = \App\Config::instance()->routes->$routePattern;
		$pattern = '#^' . preg_replace('#(\<.+\>)#iU','([^/]+)', $routePattern) . '/*$#iU';
		preg_match($pattern, $url, $matches);
		$i = 1;
		while (isset($matches[$i])){
			$routePath = str_replace('<' . $i . '>',$matches[$i], $routePath);
			$i++;
		}
		$pattern = "#^/(.+)/(.+)(\((.+)\))*$#iU";
		preg_match($pattern, $routePath, $matches);
		$controller = $matches[1];
		$action = $matches[2];
		if (isset($matches[4])){
			parse_str(str_replace(',','&',$matches[4]),$args);
		} else {
			$args = NULL;
		}
		return new Route([
			'controller' => $controller,
			'action' => $action,
			'args' => $args
		]);
	}

	private static function getPattern($url)
	{
		foreach (\App\Config::instance()->routes as $route => $action) {
			$pattern = '#^' . preg_replace('#(\<.+\>)#iU','[^/]+', $route) . '/*$#iU';
			if (preg_match($pattern, $url)){
				return $route;
			}
		};
		return false;
	}


}