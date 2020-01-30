<?php

class DB_Config
{
	public static $db_address	= 'mysql:dbname=camagru;host=127.0.0.1';
	public static $db_user		= 'camagru_manager';
	public static $db_passwd	= 'camagru';

	public static $table_queries = array(
		'users' => "
			CREATE TABLE IF NOT EXISTS users (
				id			INT				AUTO_INCREMENT PRIMARY KEY,
				username	VARCHAR(30)		UNIQUE NOT NULL,
				email		VARCHAR(255)	UNIQUE NOT NULL,
				pass_hash	VARCHAR(255)	NOT NULL
			)
		",
		'images' => "
			CREATE TABLE IF NOT EXISTS images (
				id			INT				AUTO_INCREMENT PRIMARY KEY,
				name_hash	VARCHAR(255)	UNIQUE NOT NULL,
				author_id	INT				NOT NULL,
				likes		INT				DEFAULT 0,
				FOREIGN KEY (author_id) REFERENCES users(id)
					ON DELETE CASCADE
			)
		",
		'comments' => "
			CREATE TABLE IF NOT EXISTS comments (
				id			INT				AUTO_INCREMENT PRIMARY KEY,
				text		TEXT			NOT NULL,
				author_id	INT				NOT NULL,
				image_id	INT				NOT NULL,
				FOREIGN KEY (author_id) REFERENCES users(id)
					ON DELETE CASCADE,
				FOREIGN KEY (image_id) REFERENCES images(id)
					ON DELETE CASCADE
			)
		"
	);
}

?>
