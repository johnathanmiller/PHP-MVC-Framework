<?php

/**
 * General
 * 
 * Contains miscellaneous helper functions.
 * 
 * @since 1.0.0
 */

class General {

	/**
	 * Errors
	 * 
	 * @since 1.0.10
	 * @access public
	 * @static
	 * 
	 * @param string|array $errors
	 * @return string
	 */
	public static function errors($errors) {

		$errors = (is_array($errors)) ? implode('</li><li>', $errors) : $errors;

		$html = '<div class="alert alert-danger error" role="alert">';
		$html .= '<span><strong><i class="fa fa-warning"></i> Error</strong></span>';
		$html .= '<ul><li>'. $message .'</li></ul>';
		$html .= '</div>';

		return $html;

	}

	/**
	 * Get date
	 * 
	 * @since 1.0.8
	 * @access public
	 * @static
	 * 
	 * @return string
	 */
	public static function getDate() {
		$date = date('Y-m-d H:i:s', time());
		return $date;
	}

}