<?php

class Application {

	protected $controller = 'home';
	protected $method = 'index';
	protected $no_method = '_404';
	protected $params = [];

	public function __construct() {
		
		$url = $this->parseUrl();

		if (!empty($url[0]) && file_exists(CONTROLLERS . $url[0] .'.php')) {

			// If first parameter matches controller filename set controller			
			$this->controller = $url[0];

		} else if (empty($url[0])) {

			// If parameter is empty, set controller as default controller var
			$this->controller = $this->controller;

		} else {

			// Else no parameters, set controller as default controller var
			array_unshift($url, $this->controller);
			$this->controller = $url[0];

		}

		require_once CONTROLLERS . $this->controller .'.php';
		$this->controller	= new $this->controller;

		/**
		 *
		 * If url[1] is not set, set index to url[1]
		 * If params move to url[2]
		 *
		 */

		if (!isset($url[1])) {

			// If parameter is empty, set method as default method var
			$this->method = $this->method;

		} else if (isset($url[1]) && method_exists($this->controller, $url[1])) {

			// If first parameter matches method in called controller object, set method
			$this->method = $url[1];

		} else if (!method_exists($this->controller, $url[1])) {

			/**
			 *
			 * If method is not in controller object
			 * Set controller to default controller and set method to the 404 method var
			 *
			 */
			$default_vars = get_class_vars(__CLASS__);
			$this->controller = new $default_vars['controller']();
			$this->method = $this->no_method;

		}

		// Remove controller and method parameters from url
		unset($url[0]);
		unset($url[1]);

		// If parameters remain, only return the values
		$this->params = ($url) ? array_values($url) : [];

		ob_start();
		call_user_func_array([$this->controller, $this->method], $this->params);
		ob_get_flush();

	}

	private function parseUrl() {

		if (isset($_GET['url'])) {
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}

	}

}