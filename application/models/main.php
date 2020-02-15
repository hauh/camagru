<?php

class MainModel extends Model
{
	private static $query_get_all_images =
		"SELECT filename FROM images";
	
	function getAllImages() {
		return $this->pdo->execute(self::$query_get_all_images)->fetchAll();
	}
}

?>
