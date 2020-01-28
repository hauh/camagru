<?php

class Controller_signup extends Controller
{

	function __construct()
	{
		$this->model = new Model_signup();
		$this->view = new View();
	}
	
	function index()
	{
		if (isset($_SESSION['user_id']))
			$this->view->generate('views/userpage.php', 'views/template.php');
		else
			$this->view->generate('views/signup.php', 'views/template.php');
	}

	function register()
	{
		if (isset($_POST))
		{
			$this->model->saveToDatabase($_POST['username'], $_POST['password']);
			// $_SESSION['username']	= $_POST['username'];
			// $_SESSION['user_id']	= 1;
			// $_SESSION['password']	= $_POST['password'];
			// $this->index();
			// echo "Hello, ".$_SESSION['username']."!".PHP_EOL;
		}
		else
			$this->index();
	}
}

?>