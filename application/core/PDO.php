<?php

require_once "application/config/database.php";

class PDOWrapper
{
	public static $pdo = null;

	function __construct()
	{
		if (Self::$pdo)
			return;
		try
		{
			Self::$pdo = new PDO(
				DB_Config::$db_address,
				DB_Config::$db_user,
				DB_Config::$db_passwd
			);
			Self::$pdo->setAttribute(
				PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION
			);
		}
		catch (PDOException $e) {
		    error_log("Connection failed: ".$e->getMessage());
		}
	}

	function execute($query, $data = [])
	{
		try {
			$statement = Self::$pdo->prepare($query);
			$statement->execute($data);
		} catch (PDOException $e) {
			error_log("Request\n".$query."\nfailed because: ".$e->getMessage());
		}
		return $statement;
	}
}

?>
