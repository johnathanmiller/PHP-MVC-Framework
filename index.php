<?php

$dev = (in_array($_SERVER['SERVER_ADDR'], array('::1', '127.0.0.1'))) ? true : false;

// We only want to output errors in our local environment
if ($dev === true) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

require_once './app/autoload.php';

$app = new Application;