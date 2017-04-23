<?php
namespace App;

class Route 
{
	public $controller;
	public $action;

	function __construct($data)
	{
		$this->controller = $data['controller'];
		$this->action = $data['action'];
	}

}