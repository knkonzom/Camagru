<?php include 'header.php'; ?>

<main>
	
	<?php include 'functions/php_user_functions.php';

	$image		= $_GET['image'];
	$image_id	= $_GET['id'];
	$loc		= $_SERVER['REQUEST_URI'];
	$likes		= get_likes($image_id);
	$com		= get_user_comments($image_id, 1);
	$usernames	= get_user_comments($image_id, 0); 
	$com_len 	= count($com);
	?>

<div class="comment-wrapper">
	<div class="comment-grid">
		<section class="comment-image">
			<img src="<?php echo $image; ?>">
		</section>
		<section class="comment-section">
			<?php if (isset($_SESSION['userId']) && $_SESSION['verify'] == 1)
			{?>
				<form action="includes/comments.inc.php" method="post">
				<textarea name="comment" class="my-comm" placeholder="Write a comment..."></textarea><br>
				<input type="hidden" name="img-id" value="<?php echo $image_id; ?>">
				<input type="hidden" name="loc" value="<?php echo $loc; ?>">
				<button type="submit" name="submit-comment">Send</button>
				<button id="like-btn" type="submit" name="submit-like" value="<?php echo $likes; ?>" onclick="plus_like()">Likes: <?php echo $likes; ?></button>
				</form>
				<?php
			}?>
			<fieldset class="messages">
				<?php
				$i = 0;
				while ($i < $com_len)
				{
					?>
					<span>
						<?php
						echo "<p class='comm-name'>$usernames[$i]:</p>";
						echo nl2br("\n");
						?>
					</span>
					<span>
						<?php
						echo "<p class='comm-text'>$com[$i]</p>";
						echo nl2br("\n");
						?>
					</span>
					<?php
					$i++;
				}?>
				</fieldset>
			</section>
		</div>
	</div>
	<script>
	function plus_like()
	{
		var like;
		like = parseInt(document.getElementById('like-btn').value) + 1;
		document.getElementById('like-btn').value = like.toString();
	}
	</script>
	</main>

<?php include 'footer.php'; ?>