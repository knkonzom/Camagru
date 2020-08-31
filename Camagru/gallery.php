<?php require 'header.php' ?>

<main>
	<?php
	if (!$_GET)
	{
		header("Location: index.php");
		exit();
	}
	else
	{ ?>
	<?php
	
	include 'functions/php_user_functions.php';
	$usernames	= get_username_images();
	$images		= get_images(0);
	$images_id	= get_images(1);
	$img_count	= count($images);
	$max_pages	= ceil($img_count / 6);

	$page		= intval($_GET['page']);
	$i			= ($page * 6) - 6;
	?>
	
	<body>
		<div class="gallery">
			<h2>Gallery</h2>
			<div class="gall-images">
				<?php
				$count = 0;
				while ($count < 6)
				{
					if (isset($images[$i]))
					{
						?>
						<!-- <p>Uploaded by: <?php echo $usernames[$i]; ?></p> -->
						<?php
						$loc = "comments.php?image=" . $images[$i] . "&id=" . $images_id[$i];
						?>
						<img onclick="window.location.href='<?php echo $loc; ?>'" src="<?php echo $images[$i]; ?>">
						<?php
					}
					$count++;
					$i++;
				} ?>
			</div>
			<?php
			if (intval($_GET["page"]) > 1)
			{ ?>
			<div class="prev" onclick="<?php $page = intval($_GET["page"]) - 1;
			$loc = "gallery.php?page=" . $page; ?>window.location.href='<?php echo $loc; ?>'">
			<h1>Previous</h1>
			</div>
			<?php
			}
			if (intval($_GET["page"]) < $max_pages)
			{ ?>
			<div class="next" onclick="<?php $page = intval($_GET["page"]) + 1;
			$loc = "gallery.php?page=" . $page; ?>window.location.href='<?php echo $loc; ?>'">
			<h1>Next</h1>
			</div>
			<?php
			}
			if ($max_pages == 0)
			{ ?>
			<p>No pictures uploaded...</p>
			<?php
		}
	}
	?>
	</div>
</body>
</main>

<?php require "footer.php"; ?>