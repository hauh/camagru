<?php

date_default_timezone_set('Europe/Moscow');

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', true);
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set("error_log", "camagru.log");
ini_set('log_errors_max_len', 1024);

require_once dirname(__FILE__)."/../core/SQL.php";

$sql = new SQL();
foreach (DB_Config::$table_queries as $name=>$query)
	$sql->execute($query, $name);

?>
