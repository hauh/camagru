<link rel="stylesheet" type="text/css" href="/styles/sign_form.css">
<?php
	if ($data && $data['avatar'])
		echo "<div><img src='uploads/{$data['avatar']}'></div>";
?>
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
	<div><input type="file" name="img" accept="image/*" required></div>
	<div><input type="submit" value="Upload new avatar"></div>
</form>
<form method="POST" enctype="multipart/form-data" action=/profile/uploadImage>
	<div><input type="file" name="img" accept="image/*" required></div>
	<div><input type="submit" value="Upload new image"></div>
</form>
<div>Your images<div>
<?php
	foreach ($data['images'] as $image)
	{
		echo "
			<form method='POST' action='/profile/deleteImage'>
				<div><img src='/uploads/{$image['filename']}'></div>
				<div>
					<input hidden name='image_id' value='{$image['id']}'>
					<input hidden name='filename' value='{$image['filename']}'>
					<input type='submit' value='Delete image'>
				</div>
			</form>
		";
	}
?>
