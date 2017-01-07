<?php

class Component {

	protected $controller;
	protected $view;

	public function __construct($controller, $view) {
		$this->controller = $controller;
		$this->view = $view;
	}

	public function site_title($sep = null) {

		$title_array = array();

		if ($this->controller !== 'home' && $this->view === 'index') {

			$title_array[] = ucfirst($this->controller);

		} else if ($this->view !== 'index') {

			$title_array[] = ucfirst($this->view);

		}

		$sep = ($sep === null) ? '-' : $sep;

		return (!empty($title_array)) ? implode(' ', $title_array) .' '. $sep .' '. SITE_NAME : SITE_NAME;

	}
	
	public function sidebar($name) {

		$sidebar = VIEWS . $this->controller .'/template/'. $name .'.php';
		include_once $sidebar;

	}

}