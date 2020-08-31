<?php

if (isset($_POST['signup-submit']))
{
	require '../config/database.php';

	$username		= htmlspecialchars($_POST['uid']);
	$email			= htmlspecialchars($_POST['mail']);
	$password		= htmlspecialchars($_POST['pwd']);
	$passwordRepeat = htmlspecialchars($_POST['pwd-repeat']);
	
	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
	{
		header("Location: ../signup.php?error=EmptyFields&uid=" . $username . "&mail=" . $email);
		exit();
	} 
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		header("Location: ../signup.php?error=InvalidMailuid");
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("Location: ../signup.php?error=InvalidMail&uid=" . $username);
		exit();
	}
	else if ((strlen($password) < 8))
	{
		header("Location: ../signup.php?error=PwdShort&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else if (!preg_match('/[A-Z]/', $password)) 
	{
		header("Location: ../signup.php?error=PwdNoCap&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else if (!preg_match('/[a-z]/', $password))
	{
		header("Location: ../signup.php?error=PwdNoLow&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else if (!preg_match("/[!@#$%^&*()-=`~_+,.\/<>?:;\|]/", $password))
	{
		header("Location: ../signup.php?error=PwdNoSpChar&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else if (!preg_match('/[0-9]/', $password))
	{
		header("Location: ../signup.php?error=PwdNoDigit&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else if (strstr($password, ' '))
	{
		header("Location: ../signup.php?error=PwdSpace&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		header("Location: ../signup.php?error=InvalidUid&mail=" . $email);
		exit();
	}
	else if ($password !== $passwordRepeat)
	{
		header("Location: ../signup.php?error=PasswordCheck&uid=" . $username . "&mail=" . $email);
		exit();
	}
	else
	{
		try
		{
			// SQL to create new user.
			// Uses mail function to send a verification email to user.
			$sql = "SELECT COUNT(*) FROM `users` WHERE email=:mail";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":mail", $email);
			$stmt->execute();
			$count = $stmt->fetchColumn();
			if ($count > 0)
			{
				header("Location: ../signup.php?error=MailTaken&uid=" . $username);
				exit();
			}
			else
			{
				$verificationcode	= md5(uniqid(bin2hex(random_bytes(8)), true));
				$verificationlink	= "http://localhost:8080/camagru/includes/activate.inc.php?code=" . $verificationcode;
				$to					= $email;
				$subject			= "Email Verification!";
				$msg = 
				"<p>Welcome $username!</>
				<p>Thank you for signing up. Please visit the link below to verify your account. <br /><br /></p>
				<p>$verificationlink</p>
				<p>From,<br /> Admin</p>";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

				$headers .= 'From: Admin <info@no-reply>' . "\r\n";

				if (mail($to, $subject, $msg, $headers))
				{
					try
					{
						$sql = "INSERT INTO `users` (username, email, password, verification_code) VALUES (?, ?, ?, ?)";
						$hashed =  password_hash($password, PASSWORD_DEFAULT);
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(1, $username);
						$stmt->bindParam(2, $email);
						$stmt->bindParam(3, $hashed);
						$stmt->bindParam(4, $verificationcode);
						$stmt->execute();

						header("Location: ../index.php?success=Signup&mailuid=" . $username);
						exit();
					} catch (PDOException $e) {
						die("Creating New Account error: " . $e->getMessage());
					}
				} 
				else 
				{
					echo error_get_last()['message'];
					exit();
				}
			}
		} catch (PDOException $e) {
			die("Error creating user: " . $e->getMessage());
		}
	}
	$conn = null;
}
else
{
	header("Location: ../signup.php");
	exit();
}

?>