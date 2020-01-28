<?php

class Model_signin extends Model
{
	function getData()
	{
		if (isset($_POST['username']))
			$request = "SELECT user_id FROM users WHERE users.username=".$_POST['username'];
			$result = $PDO->makeRequest($request);
			if (!$result)
			$_SESSION['user_id'] = $
		return true;
	}

	function register($username, $password)
	{
		$request = "INSERT INTO users ('username', 'password') VALUES (%s, %s)";
	}
}