<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php
	$user_id	= $_SESSION['userId'];
	?>

	<section class="update-user-info">
		<div id="pp"></div>
		<?php
		if (isset($_GET['error']))
		{
			if ($_GET['error'] == "EmptyFields")
			{
				echo '<p class="err">Fill in all fields!</p>';
			}
			else if ($_GET['error'] == "PasswordCheck")
			{
				echo '<p class="err">Passwords do not match!</p>';
			}
			else if ($_GET['error'] == "PwdShort")
			{
				echo '<p class="err">Password needs to be longer than 8 characters!</p>';
			}
			else if ($_GET['error'] == "PwdNoCap")
			{
				echo '<p class="err"Password needs at least 1 uppercase letter!</p>';
			}
			else if ($_GET['error'] == "PwdNoLow")
			{
				echo '<p class="err">Password needs at least 1 lowercase letter!</p>';
			}
			else if ($_GET['error'] == "PwdNoSpChar")
			{
				echo '<p class="err">Password needs at least 1 special character!</p>';
			}
			else if ($_GET['error'] == "PwdNoDigit")
			{
				echo '<p class="err">Password needs at least 1 digit!</p>';
			}
			else if ($_GET['error'] == "PwdSpace")
			{
				echo '<p class="err">Password should have no spaces!</p>';
			}
			else if ($_GET['error'] == "WrongPwd")
			{
				echo '<p class="err">Incorrect password!</p>';
			}
		}
		?>
		<form action="includes/update.inc.php" method="post">
		<p>Current Password: <input type="password" name="pwd-current" placeholder="Enter current password"></p>
		<p>New Password: <input type="password" name="password" placeholder="Enter new password"></p>
		<p>Confirm New Password: <input type="password" name="pwd-repeat" placeholder="Confirm new password"></p>
		<button type="submit" name="update-pass">Update User Password</button>
		<button id="info" onclick="change_field()">Exit</button>
		</form>
	</section>

</body>

</html>

<script>
	function change_field()
	{
		window.close();
	}
</script>