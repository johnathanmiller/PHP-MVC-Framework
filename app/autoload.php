<?php

spl_autoload_register('autoloader');

require_once './app/config/global.php';

function autoloader(string $class)
{
    $directories = [
        DIR['LIB'],
        DIR['STORAGE'],
        DIR['CONTROLLERS'],
        DIR['MODELS']
    ];

    foreach ($directories as $directory) {
        if (file_exists($directory . '/' . $class . '.php')) {
            return require_once $directory . '/' . $class . '.php';
        }
    }

    throw new \Exception('Failed to include class: '. $class);
}