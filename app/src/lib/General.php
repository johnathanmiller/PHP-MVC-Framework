<?php

class General {

	/**
     * Message
     * 
     * @since 1.0.0
     * @access public
     * @static
     * 
     * @param string $type
     * @param string|array $message
     * @return string
     */
    public static function message(string $type, $message) : string
    {
        $message = (is_array($message)) ? implode('</li><li>', $message) : $message;

        switch ($type) {
            case 'success':
                $alert_class = 'alert-success';
                break;
            case 'error':
                $alert_class = 'alert-danger';
                break;
            default:
                $alert_class = 'alert-info';
                break;
        }

        $html = '<div class="alert '. $alert_class .'" role="alert">';
        $html .= '<ul class="p-0 m-0" style="list-style: none;"><li>'. $message .'</li></ul>';
        $html .= '</div>';

        return $html;
	}

}