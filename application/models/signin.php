<?php

class SigninModel extends Model
{
	private static $query_authenticate =
		"SELECT id, pass_hash FROM users WHERE username = :username";

	function authenticate()
	{
		$data = [':username' => $_POST['username']];
		$user = $this->pdo->select(self::$query_authenticate, $data);
		return empty($user) ? null : $user[0];
	}

}

?>
