<?php

class Sanitize
{

    /**
     * Sanitizes email address
     * 
     * @since 2.0.0
     * @access public
     * @static
     * 
     * @param string $email Email address
     * @return string
     */
    public static function email(string $email) : string
    {
        return filter_var(trim(strtolower($email)), FILTER_SANITIZE_EMAIL);
    }

}