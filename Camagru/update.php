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
	$username	= $_SESSION['username'];
	$email		= $_SESSION['email'];
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
			else if ($_GET['error'] == "InvalidMailuid") 
			{
				echo '<p class="err">Invalid username & password!</p>';
			}
			else if ($_GET['error'] == "InvalidMail")
			{
				echo '<p class="err">Invalid email!</p>';
			}
			else if ($_GET['error'] == "InvalidUid")
			{
				echo '<p class="err">Invalid username!</p>';
			}
			else if ($_GET['error'] == "WrongPwd")
			{
				echo '<p class="err">Incorrect password!</p>';
			}
			else if ($_GET['error'] == "MailTaken")
			{
				echo '<p class="err">Email already registered!</p>';
			}
		}
		?>
		<form action="includes/update.inc.php" method="post">
		<p>New Username: <input type="text" name="username" value="<?php echo $username; ?>"></p>
		<p>New Email: <input type="email" name="email" value="<?php echo $email; ?>"></p>
		<p>Password: <input type="password" name="password" placeholder="Enter password to confirm changes."></p>
		<button type="submit" name="update-info">Update User Information</button>
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