<?php

require_once "user.php";

class ProfileModel extends UserModel
{
	private static $query_change_user_data = [
		'username'	=> "UPDATE users SET username = :new_value WHERE id = :user_id",
		'email'		=> "UPDATE users SET email = :new_value WHERE id = :user_id"
	];

	private static $query_store_image =
		"INSERT INTO images (filename, author_id) VALUES (:filename, :user_id)";

	private static $query_set_avatar =
		"UPDATE users SET avatar = :filename WHERE id = :user_id";

	private static $query_get_user_images =
		"SELECT filename FROM images WHERE author_id = :user_id";

	function changeUserData($what_to_change, $new_value, $user_id)
	{
		$statement = $this->pdo->execute(
			self::$query_change_user_data[$what_to_change],
			[
				':new_value'	=> $new_value,
				':user_id'		=> $user_id
			]
		);
		if ($statement->errorCode() != '00000')
			return $statement->errorInfo()[1] == 1062
				? "This ".$what_to_change." already taken"
				: "Unknown error happened";
		return "Your ".$what_to_change." successfully changed!";
	}

	function storeImage($user_id, $filename, $is_avatar = false)
	{
		$data = [
			':filename'		=> $filename,
			':user_id'		=> $user_id,
			':upload_date'	=> time()
		];
		$this->pdo->execute(self::$query_store_image, $data);
		if ($is_avatar)
			$this->pdo->execute(self::$query_set_avatar, $data);
	}

	function getUserImages($user_id)
	{
		return $this->pdo->execute(
			self::$query_get_user_images,
			[':user_id' => $user_id]
		)->fetchAll();
	}
}

?>
