<?php

date_default_timezone_set('UTC');

$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

defined('DS')			|| define('DS', DIRECTORY_SEPARATOR);
defined('SITE_NAME')	|| define('SITE_NAME', 'PHP MVC Framework');
defined('SITE_URL')		|| define('SITE_URL', $protocol . $_SERVER['SERVER_NAME']);
defined('ROOT_PATH')	|| define('ROOT_PATH', realpath(dirname(__FILE__) . DS .'..'. DS));
defined('ASSETS_DIR')	|| define('ASSETS_DIR', SITE_URL . DS .'assets'. DS);
defined('CSS_DIR')		|| define('CSS_DIR', ASSETS_DIR .'css');
defined('JS_DIR')		|| define('JS_DIR', ASSETS_DIR .'js');
defined('APP_DIR')		|| define('APP_DIR', 'app'. DS);
defined('INCLUDES')		|| define('INCLUDES', APP_DIR .'includes'. DS);
defined('CONTROLLERS')	|| define('CONTROLLERS', INCLUDES .'controllers'. DS);
defined('LIB')			|| define('LIB', INCLUDES .'lib'. DS);
defined('MODELS')		|| define('MODELS', INCLUDES .'models'. DS);
defined('STORAGE')		|| define('STORAGE', INCLUDES .'storage'. DS);
defined('VIEWS')		|| define('VIEWS', INCLUDES .'views'. DS);

// DATABASE CONFIGURATION
defined('DB_HOST')		|| define('DB_HOST', '');
defined('DB_USER')		|| define('DB_USER', '');
defined('DB_PASS')		|| define('DB_PASS', '');
defined('DB_NAME')		|| define('DB_NAME', '');