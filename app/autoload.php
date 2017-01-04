<?php

spl_autoload_register('autoloader');

require_once 'config.php';

function autoloader($class) {

	$controllers_path	= CONTROLLERS . $class .'.php';
	$lib_path			= LIB . $class .'.php';
	$models_path		= MODELS . $class .'.php';
	$storage_path		= STORAGE . $class .'.php';

	if (file_exists($controllers_path)) {

		require_once $controllers_path;

	} else if (file_exists($lib_path)) {

		require_once $lib_path;

	} else if (file_exists($models_path)) {

		require_once $models_path;

	} else if (file_exists($storage_path)) {

		require_once $storage_path;

	} else {

		throw new Exception('Failed to include class: '. $class);

	}
}