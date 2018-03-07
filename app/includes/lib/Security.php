<?php

class Security {

	protected static $token_name = 'csrf_token';

	public function __construct() {
		if (empty(Session::get(self::$token_name))) {
			self::generateCSRFToken();
		}
		self::verifyToken();
	}

	public static function verifyToken() {
		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			if (!isset($_REQUEST[self::$token_name]) || $_REQUEST[self::$token_name] !== Session::get(self::$token_name)) {
				header('HTTP/1.1 403 Forbidden');
				exit();
			}
		}
	}

	public static function generateCSRFToken() {
		if (function_exists('mcrypt_create_iv')) {
			Session::set(self::$token_name, bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)));
		} else {
			Session::set(self::$token_name, bin2hex(openssl_random_pseudo_bytes(32)));
		}
	}

	public static function renderCSRFInput() {
		return '<input type="hidden" name="' . Security::$token_name .'" value="' . Session::get(Security::$token_name) . '">';
	}

}