<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>My Directory<?php echo ' | '.$request['title'] ?></title>
    <?php echo $resource->css(['semantic.min.css', 'styles.css']); ?>
</head>
<body>
	<div class="ui container">

		<?php
			// Header and Nav
			include('shared/header.php');
			// Load in flash messages
			include('shared/messages.php');
			// Load in respose from Route Helper
			require_once($page);
			// Footer and Nav
			include('shared/footer.php');
		 ?>

	</div>
    <?php echo $resource->js(['jquery.min.js', 'semantic.min.js', 'script.js']); ?>
</body>
</html>
