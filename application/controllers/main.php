<?php

class MainController extends Controller
{
	function indexAction()
	{	
		$this->view->generate('views/main.php', 'views/template.php');
	}
}

?>
