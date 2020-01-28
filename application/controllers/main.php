<?php

class Controller_main extends Controller
{
	function index()
	{	
		$this->view->generate('views/main.php', 'views/template.php');
	}
}

?>
