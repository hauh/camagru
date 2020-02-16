<?php

require_once "user.php";
require_once "deletefile.trait.php";

class ProfileModel extends UserModel
{
	use DeleteFile;

	private $query_change_user_data;
	private $query_store_image;
	private $query_update_avatar;
	private $query_get_images;
	private $query_get_avatar;

	function __construct($user_id)
	{
		Parent::__construct();
		$this->query_change_user_data = [
			'username'
				=> "UPDATE users SET username = :new_value WHERE id = $user_id",
			'email'
				=> "UPDATE users SET email = :new_value WHERE id = $user_id"
		];
		$this->query_store_image =
			"INSERT INTO images (filename, author_id, upload_date)
				VALUES (:filename, $user_id, FROM_UNIXTIME(:upload_date))";
		$this->query_update_avatar =
			"UPDATE users SET avatar = :filename WHERE id = $user_id";
		$this->query_get_images =
			"SELECT id, filename FROM images WHERE author_id = $user_id
				ORDER BY upload_date DESC";
		$this->query_get_avatar =
			"SELECT avatar FROM users WHERE id = $user_id";	
	}

	function changeUserData($what_to_change, $new_value)
	{
		$statement = $this->pdo->execute(
			$this->query_change_user_data[$what_to_change],
			[':new_value' => $new_value]
		);
		if ($statement->errorCode() != '00000')
			return $statement->errorInfo()[1] == 1062
				? "This ".$what_to_change." already taken"
				: "Unknown error happened";
		return "Your ".$what_to_change." successfully changed!";
	}

	function storeImage($filename)
	{
		$this->pdo->execute(
			$this->query_store_image,
			[
				':filename'		=> $filename,
				':upload_date'	=> time()
			]
		);
	}

	function updateAvatar($filename) {
		$this->pdo->execute($this->query_update_avatar, [':filename' => $filename]);
	}
	
	function getUserImages() {
		return $this->pdo->execute($this->query_get_images)->fetchAll();
	}

	function getUserAvatar() {
		return $this->pdo->execute($this->query_get_avatar)->fetch()[0];
	}
}

?>
