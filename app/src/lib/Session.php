<?php

class Session
{

    public static function start() : void
    {
        if (!isset($_SESSION)) {
            session_start();
            new Security;
        }

        self::validate();
    }

    public static function set(string $key, $value) : void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) : ?string
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function delete(string $key) : void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() : void
    {
        session_destroy();
    }

    public static function validate() : void
    {
        if (!empty(self::get('email'))) {
            self::set('page', SITE_URL .'/'. implode('/', Url::currentPage()));

            if (time() > self::get('session_expire') || empty(self::get('session_expire'))) {
                self::destroy();

                if (self::get('page')) {
                    Url::redirect(SITE_URL .'/login?redirect='. urlencode(self::get('page')));

                } else {
                    Url::redirect(SITE_URL .'/login');
                }
            }
        }
    }

}