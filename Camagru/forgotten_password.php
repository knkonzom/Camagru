<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php
	if (isset($_GET['code']))
	{ ?>
	<section class="forget-password">
		<?php
		if (isset($_GET['error']))
		{
			if ($_GET['error'] == "EmptyFields")
			{
				echo '<p>Fill in all fields!</p>';
			}
			else if ($_GET['error'] == "PasswordCheck")
			{
				echo '<p>Passwords do not match!</p>';
			}
			else if ($_GET['error'] == "PwdShort")
			{
				echo '<p>Password needs to be longer than >= 8 characters!</p>';
			} 
			else if ($_GET['error'] == "PwdNoCap")
			{
				echo '<p>Password needs at least 1 uppercase letter!</p>';
			}
			else if ($_GET['error'] == "PwdNoLow")
			{
				echo '<p>Password needs at least 1 lowercase letter!</p>';
			}
			else if ($_GET['error'] == "PwdNoSpChar")
			{
				echo '<p>Password needs at least 1 special character!</p>';
			}
			else if ($_GET['error'] == "PwdNoDigit")
			{
				echo '<p>Password needs at least 1 digit!</p>';
			}
			else if ($_GET['error'] == "PwdSpace")
			{
				echo '<p>Password should have no spaces!</p>';
			}
			else if ($_GET['error'] == "WrongPwd")
			{
				echo '<p>Incorrect password!</p>';
			}
		} ?>
		<form action="includes/forgotten_password.inc.php" method="post">
		<input type="password" name="pwd" placeholder="Password"><br>
		<input type="password" name="pwd-repeat" placeholder="Confirm password"><br>
		<input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
		<button type="submit" name="reset-submit">Reset</button>
		</form>
	</section>
	<?php
}
else
{ ?>
<section class="forget-password">
	<?php
	if (isset($_GET['error']))
	{
		if ($_GET['error'] == "EmptyFields")
		{
			echo '<p>Fill in all fields!</p>';
		}
		else if ($_GET['error'] == "InvalidMail")
		{
			echo '<p>Invalid email!</p>';
		}
		else if ($_GET['error'] == "NoEmail")
		{
			echo '<p>Email does not exist!</p>';
		}
	}?>
	<form action="includes/forgotten_password.inc.php" method="post">
	Enter your email address: <br>
	<input type="email" name="email" placeholder="Email"><br>
	<button type="submit" name="send_mail">Send Password Reset Email</button>
	</form>
</section>
<?php
}?>

</body>

</html>