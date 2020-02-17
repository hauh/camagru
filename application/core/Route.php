<?php

class Route
{
	static function start()
	{
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		$controller_name = empty($routes[1]) ? 'Main' : strtolower($routes[1]);
		if (!file_exists("application/controllers/".$controller_name.'.php'))
			return Route::ErrorPage404();
		$argument = empty($routes[3]) ? null : $routes[3];
		$controller = Route::getController($controller_name, $argument);
		$action = empty($routes[2])
			? 'indexAction'
			: strtolower($routes[2]).'Action';
		method_exists($controller, $action)
			? $controller->$action()
			: $controller->indexAction();
	}

	static function getController($controller_name, $argument)
	{
		include_once "application/controllers/".$controller_name.'.php';
		@include_once "application/models/".$controller_name.'.php';
		$controller_name .= 'Controller';
		try {
			return new $controller_name($argument);
		}
		catch (LoginRequired $e)
		{
			include_once "application/controllers/signin.php";
			include_once "application/models/signin.php";
			return new SigninController;
		}
		catch (AlreadyLoggedIn $e)
		{
			include_once "application/controllers/profile.php";
			include_once "application/models/profile.php";
			return new ProfileController;
		}
	}

	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'page404');
    }
}

?>
