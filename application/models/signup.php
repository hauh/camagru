<?php

class SignupModel extends Model
{
	private static $query_check_username =
		"SELECT id FROM users WHERE username = :username";

	private static $query_check_email =
		"SELECT id FROM users WHERE email = :email";

	private static $query_insert_user =
		"INSERT INTO users (username, email, pass_hash)
			VALUES (:username, :email, :pass_hash)";

	function duplicateUsername()
	{
		$data = [':username' => $_POST['username']];
		return empty($this->pdo->select(self::$query_check_username, $data))
			? false : true;
	}

	function duplicateEmail()
	{
		$data = [':email' => $_POST['email']];
		return empty($this->pdo->select(self::$query_check_email, $data))
			? false : true;
	}
	
	function saveUser()
	{
		$data = array(
			':username'		=> $_POST['username'],
			':email'		=> $_POST['email'],
			':pass_hash'	=> password_hash(
								$_POST['password'], PASSWORD_DEFAULT)
		);
		if (!$this->pdo->upsert(self::$query_insert_user, $data))
			return false;
		$data = [':username' => $_POST['username']];
		return $this->pdo->select(self::$query_check_username, $data)[0];
	}
}

?>
