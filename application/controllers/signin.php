<?php

class SigninController extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new SigninModel();
	}

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
			if (($user = $this->model->authenticate()))
			{
				if (password_verify($_POST['passwd'], $user['pass_hash']))
				{
					$_SESSION['user_id']	= $user['id'];
					$_SESSION['username']	= $_POST['username'];
					$_SESSION['email']		= $_POST['email'];
				}
				else
					$this->view->alert("Wrong password :(");
			}
			else
				$this->view->alert("User not found :(");
		}
		$this->indexAction();
	}

}

?>
