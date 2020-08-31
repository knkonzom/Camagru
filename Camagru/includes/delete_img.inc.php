<?php

if (isset($_POST['del_img']))
{
	include '../config/database.php';
	$img_id = $_POST['del_img'];

	try
	{
		// SQL to delete image(s).
		$sql = "DELETE FROM `images` WHERE `image_id` = $img_id";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		header("Location: ../profile.php");
		exit();
	} catch (PDOException $e)
	{
		die("Delete Image error: " . $e->getMessage());
	}
}

?>