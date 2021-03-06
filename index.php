<?php

try {
    if (version_compare(phpversion(), '7.1', '<')) {
        throw new \Exception('Minimum required PHP version is 7.1');
    }

    require_once './vendor/autoload.php';
    require_once './app/autoload.php';

    return (new Application)->run();

} catch (\Exception $e) {
    echo '<strong>Application Error:</strong> ' . $e->getMessage();
}