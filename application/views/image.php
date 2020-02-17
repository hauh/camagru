<div><?php echo "<img src='/uploads/{$data['filename']}'>" ?></div>
<div>
	<?php
		echo "</div>Likes: {$data['likes']}</div>";
		if (isset($_SESSION) && !empty($_SESSION['user_id']))
			echo "
				</div>
					<form method='POST' action=/image/like/{$data['id']}>
						<input type='submit' value='Like'>
					</form>
				</div>
			";
	?>
</div>
