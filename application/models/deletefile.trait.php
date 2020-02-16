<?php

trait DeleteFile
{
	private static $query_delete_file =
		"DELETE FROM images WHERE id = :image_id";

	function deleteFileFromDB($file_id)
	{
		$this->pdo->execute(
			Self::$query_delete_file,
			[':image_id' => $file_id]
		);
	}

	function deleteFileFromDisk($filename)
	{
		$path = "{$_SERVER['DOCUMENT_ROOT']}/uploads/$filename";
		if (file_exists($path))
			unlink($path);
	}
}

?>
