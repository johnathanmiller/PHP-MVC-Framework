# PHP MVC Framework
[Demo](http://php-mvc.johnathanmiller.com 'PHP MVC Framework Demo')

## Connect Database
Edit file "app/config.php"
```php
defined('DB_HOST')		|| define('DB_HOST', 'your_db_host');
defined('DB_USER')		|| define('DB_USER', 'your_db_user');
defined('DB_PASS')		|| define('DB_PASS', 'your_db_password');
defined('DB_NAME')		|| define('DB_NAME', 'your_db_name');
```

## CSRF Prevention
In any form you place in a view you'll need to insert the CSRF token field right before the submit button.
```html
<input type="hidden" name="token" value="<?php echo Session::get('token'); ?>">
```
If the token is malformed by a malicious user or is not set the form will redirect to a 403 Forbidden status page on submission.