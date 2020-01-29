<?php

class Controller_signup extends Controller
{

	function __construct()
	{
		parent::__construct();
		$this->model = new Model_signup();
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
		if ($_POST &&
			isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']))
		{
			$username	= $_POST['username'];
			$email		= $_POST['email'];
			$pass_hash	= password_hash($_POST['password'], PASSWORD_DEFAULT);
			if ($this->model->getData($username, $email))
			echo "Username already exists";
			else
				$this->model->register($username, $email, $pass_hash);
		}
		else
			echo "ERROR";
		$this->index();
	}
}

?>
