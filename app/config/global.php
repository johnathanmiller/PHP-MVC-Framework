<?php

switch ($_SERVER['SERVER_ADDR']) {
    case '::1':
    case '127.0.0.1':
        require_once './app/config/dev.php';
        break;
    default:
        require_once './app/config/prod.php';
        break;
}

date_default_timezone_set('UTC');

$protocol = (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://';

// GLOBAL CONSTANTS
define('SITE_URL', $protocol . $_SERVER['SERVER_NAME']);
define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));

const SITE_NAME = 'PHP MVC Framework';
const DIR = [
    'ASSETS'        => SITE_URL . '/assets',
    'CSS'           => SITE_URL . '/assets/css',
    'JS'            => SITE_URL . '/assets/js',
    'APP'           => './app',
    'SRC'           => './app/src',
    'LIB'           => './app/src/lib',
    'STORAGE'       => './app/src/storage',
    'CONTROLLERS'   => './app/controllers',
    'MODELS'        => './app/models',
    'VIEWS'         => './app/views'
];