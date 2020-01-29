<?php

class Model_signup extends Model
{
	static $query_check_user =
		"SELECT id FROM users WHERE
			username = :username OR email = :email";

	static $query_insert_user =
		"INSERT INTO users (username, email, pass_hash)
			VALUES (:username, :email, :pass_hash)";

	function getData($username, $email)
	{
		$request = $this->pdo->prepare(self::$query_check_user);
		$request->bindParam(':username', $username);
		$request->bindParam(':email', $email);
		$result = $this->pdo->execute($request);
		if ($result)
			return true;
		return false;
	}
	
	function register($username, $email, $pass_hash)
	{
		$request = $this->pdo->prepare(self::$query_insert_user);
		$request->bindParam(':username', $username);
		$request->bindParam(':email', $email);
		$request->bindParam(':pass_hash', $pass_hash);
		$this->pdo->execute($request);
	}
}

?>
