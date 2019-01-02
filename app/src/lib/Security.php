<?php

class Security
{

    protected static $token_name = 'csrf_token';

    public function __construct()
    {
        if (empty(Session::get(self::$token_name))) {
            self::generateCSRFToken();
        }
        self::verifyToken();
    }

    protected static function verifyToken() : void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            if (!isset($_REQUEST[self::$token_name]) || $_REQUEST[self::$token_name] !== Session::get(self::$token_name)) {
                header('HTTP/1.1 403 Forbidden');
                exit();
            }
        }
    }

    protected static function generateCSRFToken() : void
    {
        if (function_exists('random_bytes')) {
            Session::set(self::$token_name, bin2hex(random_bytes(32)));

        } else if (function_exists('mcrypt_create_iv')) {
            Session::set(self::$token_name, bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)));

        } else {
            Session::set(self::$token_name, bin2hex(openssl_random_pseudo_bytes(32)));
        }
    }

    public static function renderCSRFInput() : string
    {
        return '<input type="hidden" name="' . self::$token_name .'" value="' . Session::get(self::$token_name) . '">';
    }

}