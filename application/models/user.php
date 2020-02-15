<?php

class UserModel extends Model
{
	private static $query_get_user =
		"SELECT * FROM users
			WHERE username = :username OR email = :email";
	
	function getUser($username, $email)
	{
		$user = $this->pdo->execute(
				self::$query_get_user,
				[
					':username'	=> $username,
					':email'	=> $email
				]
			)->fetchAll();
		return empty($user) ? null : $user[0];
	}
}

?>
