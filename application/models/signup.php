<?php

class Model_signup extends Model
{
	function getData()
	{
		return true;
	}

	function register($username, $password)
	{
		$request = "INSERT INTO users ('username', 'password') VALUES (%s, %s)";
	}
}