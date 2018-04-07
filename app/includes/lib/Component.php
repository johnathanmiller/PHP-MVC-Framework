<?php

class Component {

	protected $controller;
	protected $view;

	public function __construct($controller, $view) {
		$this->controller = $controller;
		$this->view = $view;
	}

	/**
	 * Site title
	 * 
	 * @since 1.0.8
	 * @access public
	 * 
	 * @param string|null $sep Separator used to separate the page title and site title. If null, we'll set a default separator.
	 * @return string
	 */
	public function site_title($sep = null) {
		$sep = ($sep === null) ? '-' : $sep;
		$title_array = [];

		if ($this->controller !== 'home' && $this->view === 'index') {
			$title_array[] = ucfirst($this->controller);

		} else if ($this->view !== 'index') {
			$title_array[] = ucfirst($this->view);
		}

		return (!empty($title_array)) ? implode(' ', $title_array) .' '. $sep .' '. SITE_NAME : SITE_NAME;

	}
	
	/**
	 * Sidebar
	 * 
	 * @since 1.0.6
	 * @access public
	 * 
	 * @param string $name Name of sidebar file excluding the extension (which should be .php).
	 * @return int|bool include_once statement will return int of 1 if output is successful, otherwise it will return false. We do not need to check for the return value since it's rendering a template.
	 */
	public function sidebar($name) {
		$path = VIEWS . $this->controller .'/template/';

		if (file_exists($path . $name .'.php')) {
			return include_once $path . $name .'.php';
		}

		throw new Exception('Sidebar with name "'. $name .'" was not found in path "'. $path .'"');
	}

}