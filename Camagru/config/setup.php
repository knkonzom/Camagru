<?php

try {

	$conn = new PDO("mysql:host=localhost", "knkonzom", "admins");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// SQL to create database
	$sql = "CREATE DATABASE IF NOT EXISTS `camagru`";
	$conn->exec($sql);
	$conn = null;

	include 'database.php';

	// Users Table setup
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
		`user_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
		`username` TINYTEXT NOT NULL,
		`email` TINYTEXT NOT NULL,
		`password` TINYTEXT NOT NULL,
		`comments_notify` BIT DEFAULT 1 NOT NULL,
		`verified` BIT DEFAULT 0 NOT NULL,
		`verification_code` varchar(264) NOT NULL
		)";
	$conn->exec($sql);

	// Image Table setup
	$sql = "CREATE TABLE IF NOT EXISTS `images`(
		`image_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
		`image_src` TEXT NOT NULL,
		`user_id` INT(11),
		FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
		)";
	$conn->exec($sql);

	// Comments Table setup
	$sql = "CREATE TABLE IF NOT EXISTS `comments`(
		`comment_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
		`comment` TEXT NOT NULL,
		`user_id` INT(11),
		`image_id` INT(11),
		FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
		FOREIGN KEY (`image_id`) REFERENCES `images`(`image_id`) ON DELETE CASCADE ON UPDATE CASCADE
		)";
	$conn->exec($sql);

	// Likes Table setup
	$sql = "CREATE TABLE IF NOT EXISTS `likes`(
		`like_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
		`like` int(11) DEFAULT 0 NOT NULL,
		`user_id` INT(11),
		`image_id` INT(11),
		FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
		FOREIGN KEY (`image_id`) REFERENCES `images`(`image_id`) ON DELETE CASCADE ON UPDATE CASCADE
		)";
	$conn->exec($sql);
	
	$conn = null;
} catch (PDOException $e) {
	die("Connection failed: " . $e->getMessage());
}
$conn = null;
