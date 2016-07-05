<?php
	ini_set("display_errors", "on");
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	require_once('controllers/ContactDirectory.php');
	// Load in namespace for class use
	use App\Contact;

	// Load the main layout
	require_once(getcwd()."/views/layouts/main.php");
