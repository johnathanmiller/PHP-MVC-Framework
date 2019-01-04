<?php

// SET ENV VARS
(new \SecureEnvPHP\SecureEnvPHP)->parse([
    'path' => '/path/to/encrypted/production/env',
    'secret' => '/path/to/production/env/key'
]);