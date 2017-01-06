# PHP MVC Framework
[Demo](http://php-mvc.johnathanmiller.com 'PHP MVC Framework Demo')

## Database Settings
Edit file `app/config.php`
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

## Controllers
The MVC framework comes packaged with a `home` controller. This will appear as the base root of your domain url, such as `http://example.com/`.

If you were to add another controller by the name of `blog` you would point your browser to `http://example.com/blog/`, given that you have a `index` method view in place.

## Views
Views are linked by methods inside the controller class. Inside the `home` controller class there are 3 methods already setup; `_404`, `index`, and `contact`. Views act as the standalone page rendered in the browser. The base root of your domain renders the index file under the `home` controller, `http://example.com/` => `index`.

Most MVC frameworks typically display the `home` controller and `index` method view in the url, but your site tends to look better without the unnecessary baggage on the home page. We leave these out by setting a default controller of `home` and a default method of `index` when no parameters are passed in the url.

## Framework Components
These consist of common elements you'd normally find on any given site. Components are callable methods to include in a view.

#### Sidebars
To display a sidebar in your view you simply place this line. The argument inside the sidebar method is looking for a filename, no need to include the extension. Make sure your sidebar file(s) are placed in the template directory of your view.
```php
<?php $get['component']->sidebar('sidebar'); ?>
```