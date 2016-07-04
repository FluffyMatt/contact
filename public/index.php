<?php
	ini_set("display_errors", "on");
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	require_once('controllers/ContactDirectory.php');
	use App\Contact;

	echo require_once(getcwd()."/views/layouts/main.php");
