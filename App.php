<?php 

use App\Config;
use App\Traits\Singleton;

class App 
{
	use Singleton;

	public function run()
	{

		try {
			$this->route = \App\Route::get($_SERVER['REQUEST_URI']);
		} catch (\App\Exceptions\RouteException $e){
			echo "Ошибка роутинга - " . $e->getMessage();
		}
		$controller = new $this->route->controller;
		$controller->action($this->route->action, $this->route->args);

	}	

}
