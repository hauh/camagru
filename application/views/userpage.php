<link rel="stylesheet" type="text/css" href="/styles/sign_form.css">
<form class=sign_form name="logout" method="POST" action=/userpage/logout>
	<div class=input_field><input type="submit" value="Log out"></div>
</form>
<form class=sign_form name="change_username" method="POST" action=/userpage/change>
	<div class=input_field><input type="text"	name="new_username"
			placeholder="Enter new username" required></div>
	<div class=input_field><input type="submit" value="Change username"></div>
</form>
<form class=sign_form name="change_mail" method="POST" action=/userpage/change>
	<div class=input_field><input type="text"	name="new_email"
			placeholder="Enter new email" required></div>
	<div class=input_field><input type="submit" value="Change email"></div>
</form>
