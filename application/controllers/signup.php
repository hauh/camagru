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
		if (!empty($_SESSION['user_id']))
			$page = 'views/userpage.php';
		else if (!empty($_SESSION['email']))
			$page = 'views/confirmation_code.php';
		else
			$page = 'views/signup.php';
		$this->view->generate($page, 'views/template.php');
	}

	private function _sendCode()
	{
		$_SESSION['code'] = rand(1000, 9999);
		mail(
			$_SESSION['email'],
			"Camagru confirmation code",
			(string)$_SESSION['code']
		);
	}

	function registerAction()
	{
		if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['passwd']))
		{
			if ($this->model->duplicateUsername())
				$this->view->alert("Username already taken");
			else if ($this->model->duplicateEmail())
				$this->view->alert("This email already registered");
			else
			{
				$_SESSION['username']	= $_POST['username'];
				$_SESSION['email']		= $_POST['email'];
				$_SESSION['passwd']		= password_hash(
								$_POST['passwd'], PASSWORD_DEFAULT);
				$this->_sendCode();
				$this->view->alert("Enter the code from email");
			}
		}
		$this->indexAction();
	}

	function checkCodeAction()
	{
		if (!empty($_POST['resend']))
		{
			$this->_sendCode();
			$this->view->alert("New code sent");
		}
		else if (!empty($_POST['back']))
			session_unset();
		else if (!empty($_POST['code']))
		{
			if ($_SESSION['code'] == $_POST['code'])
			{
				$user = $this->model->saveUser();
				if ($user)
				{
					$_SESSION['user_id'] = $user['id'];
					$this->view->alert("Registartion succesfull!");
				}
				else
					$this->view->alert("Registration failed");
			}
			else
				$this->view->alert("Wrong code :(");
		}
		$this->indexAction();
	}
}

?>
