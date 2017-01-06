<?php

class Component {

	protected $controller;

	public function __construct($controller) {
		$this->controller = $controller;
	}
	
	public function sidebar($name) {

		$sidebar = VIEWS . $this->controller .'/template/'. $name .'.php';
		include_once $sidebar;

	}

}