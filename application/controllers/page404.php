<?php

class Page404Controller extends Controller
{
	function indexAction()
	{	
		$this->view->generate('views/page404.php', 'views/template.php');
	}
}

?>
