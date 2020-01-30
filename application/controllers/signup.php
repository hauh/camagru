<?php

class SignupController extends Controller
{

	function __construct()
	{
		parent::__construct();
		$this->model = new SignupModel();
	}
	
	function indexAction()
	{
		$page = isset($_SESSION['user_id']) ? 'views/userpage.php' : 'views/signup.php';
		$this->view->generate($page, 'views/template.php');
	}

	function registerAction()
	{
		if (isset($_POST) && !empty($_POST['username'])
			&& !empty($_POST['email']) && !empty($_POST['password']))
		{
			if ($this->model->duplicateUsername())
				$status_msg = "Username already taken";
			else if ($this->model->duplicateEmail())
				$status_msg = "This email already registered";
			else
			{
				$saved = $this->model->saveUser();
				if ($saved)
				{
					$_SESSION['user_id']	= $saved['id'];
					$_SESSION['username']	= $_POST['username'];
					$_SESSION['email']		= $_POST['email'];
					$status_msg = "Registartion succesfull!";
				}
				else
					$status_msg = "Registration failed";
			}
			$this->view->alert($status_msg);
		}
		$this->indexAction();
	}
}

?>
