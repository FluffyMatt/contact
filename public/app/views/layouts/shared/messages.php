<?php
	if (array_key_exists('message', $_SESSION)) {
?>

	<div class="ui <?php echo $_SESSION['message']['type'] ?> message">
		<i class="close icon"></i>
		<div class="header">
			<?php echo $_SESSION['message']['header'] ?>
		</div>
		<p><?php echo $_SESSION['message']['message'] ?></p>
	</div>

<?php
    session_destroy();
	}
?>
