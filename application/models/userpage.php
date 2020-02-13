<?php

require_once "getuser.trait.php";

class UserpageModel extends Model
{
	use GetUser;

	private static $query_change_user_data = [
		'username'	=> "UPDATE users SET username = :new_value WHERE id = :user_id",
		'email'		=> "UPDATE users SET email = :new_value WHERE id = :user_id"
	];

	function changeUserData($what_to_change, $new_value, $user_id)
	{
		$statement = $this->pdo->execute(
			self::$query_change_user_data[$what_to_change],
			[
				':new_value'	=> $new_value,
				':user_id'		=> $user_id
			]
		);
		if ($statement->errorCode() != '00000')
			return $statement->errorInfo()[1] == 1062 ?
				"This ".$what_to_change." already taken" : "Unknown error happened";
		return "Your ".$what_to_change." successfully changed!";
	}
}

?>
