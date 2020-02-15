<div>This is main page</div>
<?php foreach ($data as $image)	{
		echo "<div><img src='/uploads/".$image['filename']."'></div>";
	}
?>
