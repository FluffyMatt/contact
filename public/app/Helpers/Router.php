<?php

/**
 * Router controller added for the varification of requested views
 */
namespace App\Helpers;

class Router
{
    // Loading route file
    protected $_routes;
	// Location of views to check
	protected $_location;
	// App config
	protected $_settings;

    // Assigns some data for use later
	function __construct()
	{
		$this->_location = getcwd().'/app/views/';
		$this->_settings = [
			'home' => getcwd().'/app/views/contacts/index.php'
		];
        $this->_routes = require_once(getcwd().'/app/config/routes.php');
	}

	/**
	 * Main request call
	 * @method request
	 * @author Matt Stephens <matthewstephens@digidev.co.uk>
	 * @param  string  $url        the url being requested
	 * @return array   $return     returns and arrya of data for the page
	 */
	public function request($url)
	{
        // Check the URL is in the routes file
        if (array_key_exists($url, $this->_routes)) {
            $route = $this->_routes[$url];
            // Check the URL
    		$return = $this->_check($route['controller'], $route['action']);
            // Load the controller to load the action
            $controllerName = ucfirst($route['controller']).'Controller';
            $controllerLocale = getcwd().'/app/Controllers/'.$controllerName.'.php';
            $action = $route['action'];
            if (file_exists($controllerLocale)) {
                $controller = "\\App\\Controllers\\$controllerName";
                $controller = new $controller();
                $load = $controller->$action($return);
                if (is_array($load)) {
                    foreach ($load as $key => $value) {
                        $return[$key] = $value;
                    }
                }
            } else {
                return $this->_error();
            }
            return $return;
        } else {
            return $this->_error();
        }
	}

	/**
	 * Main check call
	 * @method _check
	 * @author Matt Stephens <matthewstephens@digidev.co.uk>
	 * @param  string $controller string of controller name
	 * @param  string $action     string of action
	 * @return array              location of page and any other data
	 */
	private function _check($controller, $action)
	{
		$action = $this->_isGet($action);
		// Check if controller and view is set
		$page = $this->_exists($this->_location.$controller.'/'.$action.'.php');
		return [
			'page' => $page,
			'title' => strstr($page, '404.php') ? '404' : ucfirst($action),
			'get' => $_GET,
            'post' => $_POST
		];

	}

	/**
	 * Checks file exists
	 * @method _exists
	 * @author Matt Stephens <matthewstephens@digidev.co.uk>
	 * @param  string  $file file location
	 * @return string        file location or 404 location
	 */
	private function _exists($file)
	{
		// Check the existance of the file or send 404
		if (file_exists($file) && !is_dir($file)) {
			return $file;
		} else {
			return $this->_location.'errors/404.php';
		}
	}

	// Check if get values in URL
	private function _isGet($value)
    {
		if (strstr($value, '?')) {
			$get = explode('?', $value);
			return $get[0];
		} else {
			return $value;
		}
	}

    /**
     * Main error function builder
     */
    private function _error()
    {
        return [
            'page' => $this->_location.'errors/404.php',
            'title' => '404',
            'get' => $_GET
        ];
    }

}
