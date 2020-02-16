<?php

class ProfileController extends Controller
{
	function __construct()
	{
		if (!Controller::isUserLoggedIn())
			throw new LoginRequired();
		Parent::__construct($_SESSION['user_id']);
	}

	function indexAction()
	{
		$this->view->generate(
			'views/profile.php', 'views/template.php',
			[
				'avatar' => $this->model->getUserAvatar(),
				'images' => $this->model->getUserImages()
			]
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
				$this->model->changeUserData('email', $_POST['new_email']));
		else if (isset($_POST['new_username']) && !empty($_POST['new_username']))
			$this->view->alert(
				$this->model->changeUserData('username', $_POST['new_username']));
		$this->indexAction();
	}
	
	private function _saveImage()
	{
		if (!isset($_POST) || !isset($_FILES) || empty($_FILES['img']))
			return false;
		$filename = uniqid().".".pathinfo($_FILES['img']['name'])['extension'];
		if ($_FILES['img']['error'] != UPLOAD_ERR_OK
			|| !move_uploaded_file($_FILES['img']['tmp_name'], "uploads/$filename"))
		{
			$this->view->alert("File uploading failed. Try again.");
			return false;
		}
		$this->view->alert("File uploaded successfully!");
		return $filename;
	}

	function updateAvatarAction()
	{
		if ($image_name = $this->_saveImage())
		{
			if (($current_avatar = $this->model->getUserAvatar()))
				$this->model->deleteFileFromDisk($current_avatar['filename']);
			$this->model->updateAvatar($image_name);
		}
		$this->indexAction();
	}
	
	function uploadImageAction()
	{
		if ($image_name = $this->_saveImage())
			$this->model->storeImage($image_name);
		$this->indexAction();
	}

	function deleteImageAction()
	{
		if (isset($_POST) && !empty($_POST['image_id'] && !empty($_POST['filename'])))
		{
			$this->model->deleteFileFromDB($_POST['image_id']);
			$this->model->deleteFileFromDisk($_POST['filename']);
		}
		$this->indexAction();
	}
}

?>
