<?php

class SigninController extends Controller
{
	function indexAction()
	{
		if (isset($_SESSION['user_id']))
			$this->view->generate('views/userpage.php', 'views/template.php');
		else
			$this->view->generate('views/signin.php', 'views/template.php');
	}
}

?>
