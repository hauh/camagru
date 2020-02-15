<link rel="stylesheet" type="text/css" href="/styles/sign_form.css">
<form method="POST"	action=/profile/logout>
	<div><input type="submit" value="Log out"></div>
</form>
<form method="POST" action=/profile/change>
	<div><input type="text" name="new_username"
			placeholder="Enter new username" required></div>
	<div><input type="submit" value="Change username"></div>
</form>
<form method="POST" action=/profile/change>
	<div><input type="text" name="new_email"
			placeholder="Enter new email" required></div>
	<div><input type="submit" value="Change email"></div>
</form>
<form method="POST" enctype="multipart/form-data" action=/profile/updateAvatar>
	<div><input type="file" name="avatar" accept="image/*" required></div>
	<div><input type="submit" value="Upload new avatar"></div>
</form>
<div>Your images<div>
<?php foreach ($data as $image)	{
		echo "<div><img src='/uploads/".$image['filename']."'></div>";
	}
?>
