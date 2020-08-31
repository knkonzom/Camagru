<?php include "header.php"; ?>

<main>
	<div class="center">
		<div class="logins">
			<?php
			if (isset($_GET['error'])) 
			{
				if ($_GET['error'] == "EmptyFields")
				{
					echo '<p>Fill in all fields!</p>';
				}
				else if ($_GET['error'] == "InvalidMailuid")
				{
					echo '<p>Invalid username & password!</p>';
				}
				else if ($_GET['error'] == "InvalidMail")
				{
					echo '<p>Invalid email!</p>';
				}
				else if ($_GET['error'] == "InvalidUid")
				{
					echo '<p>Invalid username!</p>';
				}
				else if ($_GET['error'] == "PasswordCheck")
				{
					echo '<p>Passwords do not match!</p>';
				}
				else if ($_GET['error'] == "MailTaken")
				{
					echo '<p>Email already registered!</p>';
				}
				else if ($_GET['error'] == "PwdShort")
				{
					echo '<p>Password needs to be longer than 8 characters!</p>';
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
			}
			?>
			<form action="includes/signup.inc.php" method="post">
			<input class="email" type="text" name="uid" value="<?php if (isset($_GET['uid'])) echo $_GET['uid']; ?>" placeholder="Username"><br>
			<input class="email" type="email" name="mail" value="<?php if (isset($_GET['mail'])) echo $_GET['mail']; ?>" placeholder="E-mail"><br>
			<input class="pwd" type="password" name="pwd" placeholder="Password"><br>
			<input class="pwd" type="password" name="pwd-repeat" placeholder="Confirm password"><br>
			<button class="signup-butt" type="submit" name="signup-submit">Signup</button>
			</form>
		</div>
	</div>
</main>

<?php require "footer.php"; ?>