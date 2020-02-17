<?php

class ImageController extends Controller
{
	function __construct($image_id)
	{
		if (!$image_id)
			$this->view->redirect('/page404');
		Parent::__construct($image_id);
	}
		
	function indexAction()
	{
		if (!($image = $this->model->getImageData()))
			// $this->view->redirect('/page404');
			var_dump($image);
		$this->view->generate('views/image.php', 'views/template.php', $image);
	}

	function likeAction()
	{
		if (isset($_SESSION) && !empty($_SESSION['user_id']))
			$this->model->like($_SESSION['user_id']);
		$this->indexAction();
	}
}

?>