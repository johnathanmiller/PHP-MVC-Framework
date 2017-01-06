<?php

class General {
	
	public static function site_title($controller, $view, $sep = null) {

		$title_array = array();

		if ($controller !== 'home' && $view === 'index') {

			$title_array[] = ucfirst($controller);

		} else if ($view !== 'index') {

			$title_array[] = ucfirst($view);

		}

		$sep = ($sep === null) ? '-' : $sep;

		return (!empty($title_array)) ? implode(' ', $title_array) .' '. $sep .' '. SITE_NAME : SITE_NAME;

	}

}