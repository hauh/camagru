<?php

require_once dirname(__FILE__)."/../config/database.php";

class SQL
{
	public static $pdo = null;

	function __construct()
	{
		if (self::$pdo)
			return;
		try
		{
			self::$pdo = new PDO(
				DB_Config::$db_address,
				DB_Config::$db_user,
				DB_Config::$db_passwd
			);
			self::$pdo->setAttribute(
				PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION
			);
		}
		catch (PDOException $e) {
		    error_log("Connection failed: ".$e->getMessage());
		}
	}

	public function prepare($query)
	{
		try {
			return self::$pdo->prepare($query);
		} catch (PDOException $e) {
			error_log("Request '".$query."' failed: ".$e->getMessage());
		}
	}

	public function execute($query, $name = null)
	{
		try {
			$query->execute();
		} catch (PDOException $e) {
			error_log("Request '".$name."' failed: ".$e->getMessage());
		}
	}
}

?>
