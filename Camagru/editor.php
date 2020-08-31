<?php require 'header.php'; include 'functions/php_user_functions.php'; ?>

<main>
	<?php
	if (!$_SESSION)
	{
		header("Location: index.php");
		exit();
	}
	else if ($_SESSION['verify'] == 0)
	{
		echo '<h2 id="verify-tag">Verify account before accessing Editor page!</h2>';
		exit();
	}
	else
	{
		$images		= get_user_images(0);
		$array_size	= count($images);
		$i 			= 0;
		?>
		<section class="editor-wrapper">
			<h2>Editor</h2>
			<div class="grid-container">
				<div class="item1">
					<img class="frame" src="./stickers/frame1.png" onclick="merge('./stickers/frame1.png')"><br/>
					<img class="frame" src="./stickers/frame2.png" onclick="merge('./stickers/frame2.png')"><br/>
					<img class="frame" src="./stickers/frame3.png" onclick="merge('./stickers/frame3.png')"><br/>
					<img class="frame" src="./stickers/frame4.png" onclick="merge('./stickers/frame4.png')"><br/>
					<img class="frame" src="./stickers/frame5.png" onclick="merge('./stickers/frame5.png')"><br/>
					<img class="frame" src="./stickers/frame6.png" onclick="merge('./stickers/frame6.png')"><br/>
					<img class="frame" src="./stickers/frame7.png" onclick="merge('./stickers/frame7.png')"><br/>
					<img class="frame" src="./stickers/frame8.png" onclick="merge('./stickers/frame8.png')"><br/>
					<img class="frame" src="./stickers/frame9.png" onclick="merge('./stickers/frame9.png')"><br/>
					<img class="frame" src="./stickers/frame10.png" onclick="merge('./stickers/frame10.png')"><br/>
					<img class="frame" src="./stickers/frame11.png" onclick="merge('./stickers/frame11.png')"><br/>
					<img class="frame" src="./stickers/frame12.png" onclick="merge('./stickers/frame12.png')"><br/>
					<img class="frame" src="./stickers/frame13.png" onclick="merge('./stickers/frame13.png')"><br/>
				</div>
				<div class="item2">
					<video id="video" autoplay></video><br/>
					<button onclick="save()" id="snap">Click</button>
				</div>
				<div class="item3">
					<?php while ($i < $array_size)
					{ ?>
					<a href="<?php echo $images[$i]; ?>"><img src="<?php echo $images[$i]; ?>" /></a>
					<?php
					$i++;
					} ?>
				</div>
				<div class="item4">
					<form action="includes/image_save.inc.php" method="post">
					<canvas id="canvas" width="320" height="240"></canvas><br />
					<button id="upload" type="submit" name="upload" onclick="save_image()">Upload Image</button>
					</form>
					<button id="clear" onclick="load()">Clear</button>
				</div>
				<div class="item5">
					<form enctype="multipart/form-data">
					<input class="file" id="file" name="image" accept="image" type="file" onclick="load_image()">
					<label for="file">Select a file...</label>
					</form>
				</div>
			</div>
		</section>
		<?php
		} ?>
		
<script type="text/javascript" async src="functions/webcam.js"></script>
</main>

<?php require 'footer.php' ?>