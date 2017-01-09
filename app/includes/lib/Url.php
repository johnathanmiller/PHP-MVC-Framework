<?php

class Url {

	public static function currentPage() {
		$uri = urldecode(trim($_SERVER['REQUEST_URI'], '/'));
		$uri_parts = explode('?', $uri);

		$path = $uri_parts[0];
		$path_parts = explode('/', $path);

		return $path_parts;
	}

	public static function parameter($name, $value = null) {
		if ($value == null) {
			if (!empty($name)) {
				return true;
			}
		} else {
			if (!empty($name) && $name == $value) {
				return true;
			}
		}
	}

	public static function redirect($url) {
		header('Location: '. $url);
		exit();
	}

	public static function redirectUser($url) {
		if (array_intersect(array('login', 'signup'), self::currentPage()) && !empty(Session::get('email'))) {
			self::redirect($url);
		}
	}

}

?>