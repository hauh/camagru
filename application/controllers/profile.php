<?php

class ProfileController extends Controller
{
	function __construct()
	{
		if (!Controller::isUserLoggedIn())
			throw new LoginRequired();
		Parent::__construct();
	}

	function indexAction()
	{
		$this->view->generate(
			'views/profile.php', 'views/template.php',
			$this->model->getUserImages($_SESSION['user_id'])
		);
	}

	function logoutAction()
	{
		session_destroy();
		$_SESSION = [];
		$this->view->generate('views/main.php', 'views/template.php');
	}

	function changeAction()
	{
		if (isset($_POST['new_email']) && !empty($_POST['new_email']))
			$this->view->alert(
				$this->model->changeUserData(
					'email', $_POST['new_email'], $_SESSION['user_id']));
		else if (isset($_POST['new_username']) && !empty($_POST['new_username']))
			$this->view->alert(
				$this->model->changeUserData(
					'username', $_POST['new_username'], $_SESSION['user_id']));
		$this->indexAction();
	}
	
	function updateAvatarAction()
	{
		if (!isset($_POST) || !isset($_FILES) || empty($_FILES['avatar']))
			return $this->indexAction();
		$filename = uniqid().".".pathinfo($_FILES['avatar']['name'])['extension'];
		if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK
			&& move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/".$filename))
		{
			$this->model->storeImage($_SESSION['user_id'], $filename, true);
			$this->view->alert("File uploaded successfully!");
		}
		else
			$this->view->alert("File uploading failed. Try again.");
		$this->indexAction();
	}
}

?>
