<?php

spl_autoload_register('autoloader');

require_once './app/config/global.php';
require_once (in_array($_SERVER['SERVER_ADDR'], ['::1', '127.0.0.1'])) ? './app/config/dev.php' : './app/config/prod.php';

function autoloader($class) {

	$directories = [
		CONTROLLERS,
		LIB,
		MODELS,
		STORAGE
	];

	foreach ($directories as $directory) {
		if (file_exists($directory . $class . '.php')) {
			require_once $directory . $class . '.php';
			return;
		}
	}

	throw new Exception('Failed to include class: '. $class);
	
}