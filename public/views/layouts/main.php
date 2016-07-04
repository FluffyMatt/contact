<?php
// Starting a sessions for persisting of data
session_start();

// Loading in Route Helper
use App\Route;
require_once('./helpers/RouterController.php');
$route = new App\Helper\Route\Router;
// Making a route request
$request = $route->request($_SERVER['REQUEST_URI']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>My Directory | <?php echo $request['title'] ?></title>
	<link rel="stylesheet" href="/resources/css/semantic.min.css" />
	<link rel="stylesheet" href="/resources/css/styles.css" />
</head>
<body>
	<div class="ui container">

		<?php
			// Header and Nav
			include('shared/header.php');
			// Load in flash messages
			include('shared/messages.php');
			// Load in respose from Route Helper
			require_once($request['page']);
		 ?>

	</div>
	<script type="text/javascript" src="/resources/js/jquery.min.js"></script>
	<script type="text/javascript" src="/resources/js/script.js"></script>
</body>
</html>
