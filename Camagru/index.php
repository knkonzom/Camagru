<?php include "header.php"; include_once "config/setup.php"; ?>

<main>
	<div class="center">
		<div class="logins">
			<h5>Welcome!</h5>
			<?php
			if (isset($_GET['error']))
			{
				if ($_GET['error'] == "EmptyFields")
				{
					echo '<p>Fill in all fields<!/p>';
				}
				else if ($_GET['error'] == "WrongPwd")
				{
					echo '<p>Incorrect password!</p>';
				}
				else if ($_GET['error'] == "NoUser")
				{
					echo '<p>Please sign-up to sign-in!</p>';
				}
				else if ($_GET['error'] == "UpdateFiles")
				{
					echo '<p>Failed to verify account!</p>';
				}
			}
			if (isset($_GET['success']))
			{
				if ($_GET['success'] == "signup")
				{
					echo '<p class="success">Registered!<br />Verify email to login<p>';
				}
				else if ($_GET['success'] == "verified")
				{
					echo '<p class="success">Verified!<br />Please login<p>';
				}
				else if ($_GET['success'] == "pwdchanged")
				{
					echo '<p class="success">Password successfully changed!<br />Please login<p>';
				}
				else if ($_GET['success'] == "pwdreset")
				{
					echo '<p class="success">Please check email to reset your password!<p>';
				}
			}
			?>
			<form action="includes/login.inc.php" method="post">
			<input class="email" type="text" name="mailuid" value="<?php if (isset($_GET['mailuid'])) echo $_GET['mailuid']; ?>" placeholder="Username/E-mail"><br>
			<input class="pwd" type="password" name="pwd" placeholder="Password"><br>
			<button class="login-butt" type="submit" name="login-submit">Login</button><br>
			</form>
			<input type="button" class="signup-butt" value="Signup" onclick="location.href='signup.php';"><br>
				<input onclick="window.location.href='gallery.php?page=1.php'" type="submit" name="guest" value="guest" class="guest-butt">
			<p style="color:#5e4200">Forgotten password? click <a href="forgotten_password.php"> here</a></p>
		</div>
	</div>
</main>

<?php require "footer.php"; ?>