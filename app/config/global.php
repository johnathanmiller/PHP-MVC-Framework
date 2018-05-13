<?php

date_default_timezone_set('UTC');

$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';

define('SITE_URL', $protocol . $_SERVER['SERVER_NAME']);
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));

// GLOBAL CONSTANTS
const DS = DIRECTORY_SEPARATOR;
const SITE_NAME = 'PHP MVC Framework';
const ASSETS_DIR = SITE_URL . DS . 'assets';
const CSS_DIR = ASSETS_DIR . DS . 'css';
const JS_DIR = ASSETS_DIR . DS . 'js';
const APP_DIR = 'app' . DS;
const INCLUDES = APP_DIR . 'includes' . DS;
const CONTROLLERS = INCLUDES . 'controllers' . DS;
const LIB = INCLUDES . 'lib' . DS;
const MODELS = INCLUDES . 'models' . DS;
const STORAGE = INCLUDES . 'storage' . DS;
const VIEWS = INCLUDES . 'views' . DS;