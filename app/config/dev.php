<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// SET ENV VARS
$dotenv = new \Dotenv\Dotenv('/path/to/dev/env/dir', '.env.dev');
$dotenv->load();