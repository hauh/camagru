<?php

class UserpageController extends Controller
{
	function indexAction()
	{
		if (!empty($_SESSION['user_id']))
			$page = 'views/userpage.php';
		else
			$page = 'views/signin.php';
		$this->view->generate($page, 'views/template.php');
	}

	function authAction()
	{
		if (!empty($_POST['username'] && !empty($_POST['passwd'])))
		{
			if (($user = $this->model->getUser($_POST['username'], "")))
			{
				if (password_verify($_POST['passwd'], $user['pass_hash']))
				{
					$_SESSION['user_id']	= $user['id'];
					$_SESSION['username']	= $user['username'];
					$_SESSION['email']		= $user['email'];
				}
				else
					$this->view->alert("Wrong password :(");
			}
			else
				$this->view->alert("User not found :(");
		}
		$this->indexAction();
	}

	function logoutAction()
	{
		session_destroy();
		$this->indexAction();
	}

	function changeAction()
	{
		if (!empty($_SESSION['user_id']))
		{
			if (!empty($_POST['new_email']))
				$this->view->alert(
					$this->model->changeUserData(
						'email', $_POST['new_email'], $_SESSION['user_id']));
			else if (!empty($_POST['new_username']))
				$this->view->alert(
					$this->model->changeUserData(
						'username', $_POST['new_username'], $_SESSION['user_id']));
		}
		$this->indexAction();
	}
}

?>
