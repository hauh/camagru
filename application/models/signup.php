<?php

require_once "user.php";

class SignupModel extends UserModel
{
	private static $query_insert_user =
		"INSERT INTO users (username, email, pass_hash)
			VALUES (:username, :email, :pass_hash)";

	function duplicateUserData($username, $email)
	{
		if (!($user = $this->getUser($username, $email)))
			return null;
		if ($user['username'] == $username)
			return "username";
		if ($user['email'] == $email)
			return "email";
	}

	function saveUser($username, $email, $pass_hash)
	{
		if ($this->pdo->execute(
					Self::$query_insert_user,
					[
						':username'		=> $username,
						':email'		=> $email,
						':pass_hash'	=> $pass_hash
					]
				)->errorCode() != '00000'
			)
			return null;
		return $this->getUser($username, $email)['id'];
	}
}

?>
