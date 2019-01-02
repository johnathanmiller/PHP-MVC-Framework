<?php

class Date
{

    /**
     * ISO Date
     * 
     * @since 2.0.0
     * @access public
     * @static
     * 
     * @return string
     */
    public static function inISO() : string
    {
        return date(DATE_ISO8601);
    }

}