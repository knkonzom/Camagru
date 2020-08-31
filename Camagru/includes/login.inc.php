<?php

if (isset($_POST['login-submit']))
{
	require '../config/database.php';

	$mailuid	= htmlspecialchars($_POST['mailuid']);
	$password	= htmlspecialchars($_POST['pwd']);

	if (empty($mailuid) || empty($password))
	{
		header("Location: ../index.php?error=EmptyFields");
		exit();
	}
	else
	{
		try
		{
			// SQL to select user using unique ID.
			$sql = "SELECT * FROM `users` WHERE `username`= :mailuid OR `email` = :mailuid";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":mailuid", $mailuid);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$passCheck = password_verify($password, $result['password']);

			if (!$result)
			{
				header("Location: ../index.php?error=NoUser");
				exit();
			}
			if ($passCheck == false)
			{
				header("Location: ../index.php?error=WrongPwd&Mailuid=" . $mailuid);
				exit();
			}
			else if ($passCheck == true)
			{
				session_start();
				$_SESSION['userId']		= $result['user_id'];
				$_SESSION['username']	= $result['username'];
				$_SESSION['verify']		= $result['verified'];
				$_SESSION['email']		= $result['email'];

				header("Location: ../gallery.php?page=1");
				exit();
			}
			else
			{
				header("Location: ../index.php?error=WrongPwd");
				exit();
			}
		} catch (PDOException $e) {
			die("Login error: " . $e->getMessage());
		}
	}
}
else if (isset($_POST['logout-submit']))
{
	session_start();
	session_unset();
	session_destroy();

	header("Location: ../index.php");
	exit();
}
// ---------------------------------------------------------------------- 
else if (isset($_POST['guest-login-submit']))
{
	require '../config/database.php';

	$mailuid	= htmlspecialchars($_POST['mailuid']);
	$password	= htmlspecialchars($_POST['pwd']);

	if (empty($mailuid) || empty($password))
	{
		header("Location: ../gallery.php?page=1&error=emptyfields");
		exit();
	}
	else
	{
		try
		{
			$sql = "SELECT * FROM `users` WHERE `username`= :mailuid OR `email` = :mailuid";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":mailuid", $mailuid);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$passCheck = password_verify($password, $result['password']);

			if (!$result)
			{
				header("Location: ../gallery.php?page=1&error=NoUser");
				exit();
			}
			if ($passCheck == false)
			{
				header("Location: ../gallery.php?page=1&error=wrongpwd");
				exit();
			}
			else if ($passCheck == true)
			{
				session_start();
				$_SESSION['userId']		= $result['user_id'];
				$_SESSION['username']	= $result['username'];
				$_SESSION['verify']		= $result['verified'];
				$_SESSION['email']		= $result['email'];
				header("Location: ../gallery.php?page=1");
				exit();
			}
			else
			{
				header("Location: ../gallery.php?page=1&error=WrongPwd");
				exit();
			}
		} catch (PDOException $e) {
			die("Guest Login error: " . $e->getMessage());
		}
	}
}
else
{
	header("Location: ../gallery.php?page=1");
	exit();
}

?>