<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/styles/header.css">
	<title>Camagru</title>
</head>
<body>
	<header>
		<div class=header_menu>
			<?php if (isset($_SESSION) && !empty($_SESSION['user_id']))
				{
					?>
						<a href=/main>Main page</a>
						<a href=/profile>Profile</a>
						<a href=/page404>Something</a>
					<?php
				}
				else
				{
					?>
						<a href=/main>Main page</a>
						<a href=/signin>Sign in</a>
						<a href=/signup>Sign up</a>
						<a href=/page404>Something</a>
					<?php
				}
			?>
		</div>
	</header>
	<?php include 'application/'.$content_view; ?>
</body>
</html>
