<?php
namespace App;
use \App\Exceptions;

class Router 
{
	use \App\Singleton;

	const DEFAULT_ACTION = 'Index';
	private $path;
	private $args = [];

	public static function startPageController()
	{
		return '\\App\\Controllers\\Main';
	}
	public static function startPageAction()
	{
		return 'Index';
	}

	public static function parseUrl($url)
	{
		$path = trim(parse_url($url, PHP_URL_PATH), '/');
		parse_str(parse_url($url, PHP_URL_QUERY), $args);
		switch ($path) {
			case '':
			case 'index.php':
				$controller = self::startPageController();
				$action = self::startPageAction();
				break;
			
			default:
				$path_array = explode('/',$path);
				foreach ($path_array as $k=>$v){
					$path_array[$k] = ucfirst($v);
				}
				$controller = '\\App\\Controllers\\' . implode('\\', $path_array);
				$action = self::DEFAULT_ACTION;
				if (!class_exists($controller)){
					$action = array_pop($path_array);
					$controller = '\\App\\Controllers\\' . implode('\\', $path_array);
				}
		}

		if (!class_exists($controller)){
			throw new Exceptions\RouteException('Контроллер ' . $controller . ' не найден');
		} elseif (!$controller::existsAction($action)){
			throw new Exceptions\RouteException('В контроллере ' . $controller . ' не найден метод ' . $action);
		} else {
			return new Route([
				'controller' => $controller,
				'action' => $action
			]);
		}

	}
}