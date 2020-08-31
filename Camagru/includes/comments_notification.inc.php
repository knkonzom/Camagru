<?php session_start();

if (isset($_SESSION['userId']))
{
	include '../config/database.php';
	$user_id = $_SESSION['userId'];

	// Turn on or off email comments notifications.
	try
	{
		if (isset($_POST['mail-notify']))
		{
			$sql = "UPDATE `users` SET `comments_notify` = 1 WHERE `user_id` = $user_id";
		}
		if (!isset($_POST['mail-notify']))
		{
			$sql = "UPDATE `users` SET `comments_notify` = 0 WHERE `user_id` = $user_id";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		header("Location: ../profile.php");
		exit();
	} catch (PDOException $e) {
		die("Connection failed: " . $e->getMessage());
	}
}
else
{
	header("Location: ../index.php");
	exit();
}

?>