<?php

class SignupController extends Controller
{
	function indexAction()
	{
		if (isset($_SESSION) && !empty($_SESSION['user_id']))
			$page = 'views/profile.php';
		else if (!empty($_SESSION['code']))
			$page = 'views/mailcode.php';
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
		if (empty($_SESSION['user_id']) && !empty($_POST['username'])
			&& !empty($_POST['email']) && !empty($_POST['passwd']))
		{
			if (($duplicate_what = $this->model->duplicateUserData(
					$_POST['username'], $_POST['email'])))
				$this->view->alert("This ".$duplicate_what." already taken");
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
		else if (!empty($_POST['code'] && empty($_SESSION['user_id'])))
		{
			if ($_SESSION['code'] == $_POST['code'])
			{
				if (($_SESSION['user_id'] = $this->model->saveUser(
						$_SESSION['username'], $_SESSION['email'], $_SESSION['passwd'])))
					$this->view->alert("Registartion succesfull!");
				else
					$this->view->alert("Registration failed. Try again or contact admin.");
				unset($_SESSION['code']);
			}
			else
				$this->view->alert("Wrong code :(");
		}
		$this->indexAction();
	}

}

?>
