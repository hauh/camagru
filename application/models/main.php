<?php

class MainModel extends Model
{
	private static $query_get_all_images =
		"SELECT filename FROM images
			ORDER BY upload_date DESC";
	
	function getAllImages() {
		return $this->pdo->execute(Self::$query_get_all_images)->fetchAll();
	}
}

?>
