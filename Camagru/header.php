<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Camagru</title>
	<link rel="stylesheet" media="all" href="style.css">

</head>
<header>
	<?php
	if (isset($_SESSION['userId']))
	{ ?>
	<nav>
		<ul class="nav-links">
			<li><a href="profile.php">Profile</a></li>
			<li><a href="gallery.php?page=1">Gallery</a></li>
			<li><a href="editor.php">Editor</a></li>
		</ul>
	</nav>
	
	<div class="nav-input">
		<form action="includes/login.inc.php" method="post">
		<button class="logout-butt" type="submit" name="logout-submit">Logout</button>
		</form>
	</div>
	<?php
	}
	else if (!$_SESSION && isset($_GET['page']))
	{ ?>
		<div class="nav-input">
		<form action="includes/login.inc.php" method="post">
		<input type="text" name="mailuid" value="<?php if (isset($_GET['mailuid'])) echo $_GET['mailuid']; ?>" placeholder="Username or e-mail">
		<input type="password" name="pwd" placeholder="Enter Password">
		<button type="submit" name="guest-login-submit">Login</button>
		<input class="login-butt" type="button" value="Login" onclick="location.href='index.php'">
		<input class="signup-butt" type="button" value="Signup" onclick="location.href='signup.php'">
		</form>
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
	}
		echo '</div>';
	}
	?>
</header>

</html>