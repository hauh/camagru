<?php

class Controller_404 extends Controller
{
	function index()
	{	
		$this->view->generate('views/404.php', 'views/template.php');
	}
}

?>
