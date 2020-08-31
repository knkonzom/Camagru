<?php

if (isset($_POST['send_mail'])) 
{
	include '../config/database.php';
	$email = htmlspecialchars($_POST['email']);

	if (empty($email)) 
	{
		header("Location: ../forgotten_password.php?error=emptyfields");
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		header("Location: ../forgotten_password.php?error=invalidmail");
		exit();
	}
	else
	{
		try
		{
			$sql = "SELECT * FROM `users` WHERE email = :mail";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":mail", $email);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0)
			{
				$result		= $stmt->fetch(PDO::FETCH_ASSOC);
				$user_id	= $result['user_id'];
				$username	= $result['username'];

				$to = $email;
				$subject = "Password Reset Email";
				$url = "http://localhost:8080/camagru/forgotten_password.php?code=" . base64_encode($user_id);
				$msg = "
						<p>Hi $username,</p>
						<p>Use the link below to reset your password: <br /><br /></p>
						<p>$url</p>
						<p>From,<br /> Admin</p>";

				$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: Admin <info@no-reply>' . "\r\n";

				if (mail($to, $subject, $msg, $headers))
				{
					header("Location: ../index.php?success=PwdReset");
					exit();
				}
				else
				{
					header("Location: ../forgotten_password.php?error=MailError");
					exit();
				}
			}
			else
			{
				header("Location: ../forgotten_password.php?error=NoEmail");
				exit();
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
else if (isset($_POST['reset-submit']))
{
	include '../config/database.php';

	$code		= $_POST['code'];
	$user_id	= intval(base64_decode(($_POST['code'])));
	$pwd		= htmlspecialchars($_POST['pwd']);
	$pwd_repeat	= htmlspecialchars($_POST['pwd-repeat']);

	if (empty($pwd) || empty($pwd_repeat))
	{
		header("Location: ../forgotten_password.php?error=EmptyFields&code=" . $code);
		exit();
	} 
	else if ((strlen($pwd) < 8))
	{
		header("Location: ../forgotten_password.php?error=PwdShort&code=" . $code);
		exit();
	}
	else if (!preg_match('/[A-Z]/', $pwd))
	{
		header("Location: ../forgotten_password.php?error=PwdNoCap&code=" . $code);
		exit();
	}
	else if (!preg_match('/[a-z]/', $pwd))
	{
		header("Location: ../forgotten_password.php?error=PwdNoLow&code=" . $code);
		exit();
	}
	else if (!preg_match("/[!@#$%^&*()-=`~_+,.\/<>?:;\|]/", $pwd))
	{
		header("Location: ../forgotten_password.php?error=PwdNoSpChar&code=" . $code);
		exit();
	}
	else if (!preg_match('/[0-9]/', $pwd))
	{
		header("Location: ../forgotten_password.php?error=NoDigit&code=" . $code);
		exit();
	}
	else if (strstr($pwd, ' '))
	{
		header("Location: ../forgotten_password.php?error=PwdSpace&code=" . $code);
		exit();
	}
	else if ($pwd !== $pwd_repeat)
	{
		header("Location: ../forgotten_password.php?error=PwdCheck&code=" . $code);
		exit();
	}
	else
	{
		try
		{
			$sql = "UPDATE `users` SET `password` = ? WHERE `user_id` = ?";
			$stmt = $conn->prepare($sql);
			$hashed = password_hash($pwd, PASSWORD_DEFAULT);
			$stmt->bindParam(1, $hashed);
			$stmt->bindParam(2, $user_id);

			if ($stmt->execute())
			{
				header("Location: ../index.php?success=PwdChanged");
				exit();
			}
		} catch (PDOException $e) {
			die("Password Reset error:" . $e->getMessage());
		}
	}
}

?>