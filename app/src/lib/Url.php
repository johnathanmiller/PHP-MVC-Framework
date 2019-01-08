<?php

class Url
{

    public static function currentPage() : array
    {
        $uri = urldecode(trim($_SERVER['REQUEST_URI'], '/'));
        $uri_parts = explode('?', $uri);

        $path = $uri_parts[0];
        $path_parts = explode('/', $path);

        return $path_parts;
    }

    public static function isActive(string $page, string $default_class) : string
    {
        if (self::currentPage()[0] === $page) {
            return $default_class . ' active';
        }
        return $default_class;
    }

    /**
     * Redirect
     * 
     * @since 1.0.0
     * @access public
     * @static
     * 
     * @param string $url Url to redirect to.
     */
    public static function redirect(string $url) : void
    {
        header('Location: '. $url);
        exit();
    }

    /**
     * Require Redirect
     * 
     * @since 1.0.0
     * @access public
     * @static
     * 
     * @param bool $redirect Value given by controller based on page parameter for required sesssion.
     * @see Url::redirect
     */
    public static function requireRedirect(bool $redirect) : void
    {
        if (($redirect) && empty(Session::get('email'))) {
            self::redirect(SITE_URL .'/login');
        }
    }

}