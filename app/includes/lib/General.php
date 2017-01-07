<?php

class General {

	public static function getDate() {
		$date = date('Y-m-d H:i:s', time());
		return $date;
	}

}