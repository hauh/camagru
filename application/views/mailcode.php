<link rel="stylesheet" type="text/css" href="/styles/sign_form.css">
<form class=sign_form name="code" method="POST" action=/signup/checkCode>
	<div class=input_field><input type="text"	name="code"
			placeholder="Enter confirmation code here" required></div>
	<div class=input_field><input type="submit" value="Submit"></div>
	<div class=input_field><input type="submit" name="resend" value="Send new code" formnovalidate></div>
	<div class=input_field><input type="submit" name="back" value="Back" formnovalidate></div>
</form>
