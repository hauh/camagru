<?php

require_once "config/ini.php";
require_once "application/core/PDO.php";

$pdo = new PDOWrapper();
foreach (DB_Config::$table_queries as $name=>$query)
	$pdo->execute($query);

?>
