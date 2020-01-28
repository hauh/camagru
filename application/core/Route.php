<?php

class Route
{
	static function start()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		$controller_name = empty($routes[1]) ? 'main' : strtolower($routes[1]);

		@include "application/models/".$controller_name.'.php';

		$controller_file = "application/controllers/".$controller_name.'.php';
		if (!file_exists($controller_file))
			Route::ErrorPage404();
		include $controller_file;
		$controller_name = 'Controller_'.$controller_name;
		$controller = new $controller_name;
		$action = empty($routes[2]) ? 'index' : strtolower($routes[2]);
		if (!method_exists($controller, $action))
			Route::ErrorPage404();
		$controller->$action();
	}
	
	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}

?>
