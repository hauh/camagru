<?php

require_once "application/config/database.php";

class PDOWrapper
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

	private function _execute($query, $data)
	{
		try {
			$statement = self::$pdo->prepare($query);
			if ($statement->execute($data))
				return $statement;
		} catch (PDOException $e) {
			error_log("Request\n".$query."\nfailed because: ".$e->getMessage());
		}
		return null;
	}

	public function upsert($query, $data = [])	{
		return $this->_execute($query, $data) ? true : false;
	}

	public function select($query, $data = [])
	{
		$statement = $this->_execute($query, $data);
		return $statement ? $statement->fetchAll() : [];
	}
}

?>
