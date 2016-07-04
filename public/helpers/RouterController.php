<?php

/**
 * Router controller added for the varification of requested views
 */

namespace App\Helper\Route;

class Router
{
	// Location of views to check
	private $_location;
	// App config
	private $_settings;

	function __construct()
	{
		$this->_location = getcwd().'/views/';
		$this->_settings = [
			'home' => getcwd().'/views/contacts/index.php'
		];
	}

	// Main routing call
	public function request($url)
	{
		// Explode out URL for use
		$url = explode('/', $url);
		// Standard REST style URLs
		$controller = $url[1];
		$view = $url[2];
		// Check the URL
		$checked = $this->_check($controller, $view);
		// Return the result
		return $checked;
	}

	// Builds and calls exists on request
	private function _check($controller, $view)
	{
		$view = $this->_isGet($view);
		// Check if controller and view is set
		if (is_null($view)) {
			$page = $this->_exists($controller.'/'.$view);
			return [
				'page' => $page,
				'title' => strstr($page, '404.php') ? '404' : ucfirst($controller),
				'get' => $_GET
			];
		} else {
			$page = $this->_exists($controller.'/'.$view);
			return [
				'page' => $page,
				'title' => strstr($page, '404.php') ? '404' : ucfirst($view),
				'get' => $_GET
			];
		}

	}

	// Check if file/dir exists
	private function _exists($file)
	{
		// Check is request is for home page
		$file = $file == '/' || $file == '' ? $this->_settings['home'] : $this->_location.$file.'.php';
		// Check the existance of the file or send 404
		if (file_exists($file) && !is_dir($file)) {
			return $file;
		} else {
			return $this->_location.'errors/404.php';
		}
	}

	// Check if get values in URL
	private function _isGet($value) {
		if (strstr($value, '?')) {
			$get = explode('?', $value);
			return $get[0];
		} else {
			return $value;
		}
	}

}
