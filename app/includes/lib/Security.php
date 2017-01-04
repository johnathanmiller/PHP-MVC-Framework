<?php

class Security {

	public function __construct() {

		if (empty(Session::get('token'))) {
			self::generateCSRFToken();
		}

		self::verifyToken();
	}

	public static function verifyToken() {

		$token_name = 'token';

		if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
			if (!isset($_REQUEST[$token_name]) || $_REQUEST[$token_name] !== Session::get('token')) {
				header('HTTP/1.1 403 Forbidden');
				exit();
			}
		}
	}

	public static function generateCSRFToken() {
		if (function_exists('mcrypt_create_iv')) {
			Session::set('token', bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)));
		} else {
			Session::set('token', bin2hex(openssl_random_pseudo_bytes(32)));
		}
	}

}