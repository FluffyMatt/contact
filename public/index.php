<?php
// Autoload our namespaces using PSR-4
require __DIR__.'/vendor/autoload.php';

// Call our namespaces
use App\Helpers\Router;
use App\Helpers\Resource;

// Load session for use with flash messages
session_start();

// Routing takes place
$route = new Router;
$request = $route->request($_SERVER['REQUEST_URI']);

if (!stristr($request['page'], 'json')) {
    // Instantiate Resource to allow for css and js loading
    $resource = new Resource();
    // Page response from router assigned to variable
    foreach ($request as $key => $value) {
        ${$key} = $value;
    }
    // Load the main layout
    require_once(getcwd()."/app/views/layouts/main.php");
} else {
    // Resposes assigned to variables
    foreach ($request as $key => $value) {
        ${$key} = $value;
    }
    // Load JSON layout
    include($request['page']);
}
