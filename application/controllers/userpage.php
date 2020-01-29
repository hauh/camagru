<?php

class Controller_userpage extends Controller
{
	function index()
	{
		if (isset($_SESSION['user_id']))
			$this->view->generate('views/userpage.php', 'views/template.php');
		else
			$this->view->generate('views/signup.php', 'views/template.php');
	}
}

?>
