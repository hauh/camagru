<?php

class Controller
{
	public $model;
	public $view;
	
	function __construct($user_id = null)
	{
		$this->view = new View();
		$model_name = str_replace('Controller', 'Model', get_class($this));
		$this->model = class_exists($model_name) ? new $model_name($user_id) : null;
	}

	static function isUserLoggedIn() {
		return isset($_SESSION) && !empty($_SESSION['user_id']) ? true : false;
	}

	function indexAction() {}
}

?>
