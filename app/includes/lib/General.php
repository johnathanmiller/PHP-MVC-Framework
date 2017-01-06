<?php

class General {
	
	public static function site_title($controller, $view, $sep = null) {

		$title_array = array();

		$sep = ($sep === null) ? '-' : $sep;

		if ($controller !== 'home' && $view === 'index') {

			$title_array[] = ucfirst($controller);
			$title_array[] = $sep;

		} else if ($view !== 'index') {

			$title_array[] = ucfirst($view);
			$title_array[] = $sep;

		}

		return (!empty($title_array)) ? implode(' ', $title_array) .' '. SITE_NAME : SITE_NAME;

	}

}