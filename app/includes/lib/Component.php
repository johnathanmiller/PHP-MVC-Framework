<?php

class Component {

	protected $controller;
	protected $view;

	public function __construct($controller, $view) {
		$this->controller = $controller;
		$this->view = $view;
	}


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
	
	public function sidebar($name) {
		$path = VIEWS . $this->controller .'/template/';

		if (file_exists($path . $name .'.php')) {
			return include_once $path . $name .'.php';
		}

		throw new Exception('Sidebar with name "'. $name .'" was not found in path "'. $path .'"');
	}

}