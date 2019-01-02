# PHP MVC Framework
[Demo](http://php-mvc.johnathanmiller.com 'PHP MVC Framework Demo')

## Controllers
The MVC framework comes packaged with a `home` controller. This will appear as the base root of your domain url, such as `http://example.com/`.

If you were to add another controller by the name of `blog` you would point your browser to `http://example.com/blog/`, given that you have a `index` method view in place.

## Views
Views are linked by methods inside the controller class. Inside the `home` controller class there are 3 methods already setup; `_404`, `index`, and `contact`. Views act as the standalone page rendered in the browser. The base root of your domain renders the index file under the `home` controller, `http://example.com/` => `index`.

Most MVC frameworks typically display the `home` controller and `index` method view in the url, but your site tends to look better without the unnecessary baggage on the home page. We leave these out by setting a default controller of `home` and a default method of `index` when no parameters are passed in the url.

## CSRF Prevention
In your forms you'll need to insert the `render CSRF input method` right before the submit button.
```twig
{{ security('renderCSRFInput') | raw }}
```
If the token is not set in the form or if it's malformed by a malicious user the page will redirect to a 403 Forbidden page on submission.

## Configs
Configuration file are located in the `app/config/` directory. The `dev.php` has errors turned on and expects a `.env` file to load environment variables. The `prod.php` file expects an encrypted `.env` file and a secret key file `.key`.  
  
The `global.php` config file will load predefined constants and the dev or prod config depending on your environment.