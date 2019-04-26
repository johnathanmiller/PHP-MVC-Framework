<?php

// SET ENV VARS
(new SecureEnvPHP\SecureEnvPHP)->parse('/path/to/encrypted/production/env', '/path/to/production/env/key');