<?php

require_once './app/config/global.php';

spl_autoload_register('autoloader');

function autoloader(string $class)
{
    if (class_exists($class)) {
        return;
    }

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

    throw new \Exception('Failed to include class: ' . $class);
}