<?php

class ImageModel extends Model
{
	private $query_get_image;
	private $query_get_likes;
	private $query_like;
		
	function __construct($image_id)
	{
		Parent::__construct();
		$this->query_get_image =
			"SELECT * FROM images WHERE id = $image_id";
		$this->query_get_likes =
			"SELECT COUNT(*) FROM likes WHERE image_id = $image_id";
		$this->query_like =
			"INSERT INTO likes (user_id, image_id) VALUES (:user_id, $image_id)
				ON CONFLICT DELETE FROM likes
					WHERE user_id = :user_id AND image_id = $image_id";
			// "UPDATE images SET likes = likes + 1 WHERE id = $image_id";
	}

	function getImageData()
	{
		$image = $this->pdo->execute($this->query_get_image)->fetch();
		$likes = $this->pdo->execute($this->query_get_likes)->fetch()[0];
		return array_merge($image, ['likes' => $likes]);
	}

	function like($user_id) {
		$this->pdo->execute($this->query_like, [':user_id' => $user_id]);
	}
}
