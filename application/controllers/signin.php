<?php

class SigninController extends Controller
{
	function indexAction()
	{
		if (isset($_SESSION) && !empty($_SESSION['user_id']))
			$this->view->redirect('/profile');
		else
			$this->view->generate('views/signin.php', 'views/template.php');
	}

	function authAction()
	{
		if (isset($_POST['username']) && !empty($_POST['username']
			&& isset ($_POST['passwd']) && !empty($_POST['passwd'])))
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
}

?>
