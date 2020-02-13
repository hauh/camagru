<?php

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
		$model_name = str_replace('Controller', 'Model', get_class($this));
		$this->model = class_exists($model_name) ? new $model_name : null;
	}
	
	function indexAction() {}
}

?>
