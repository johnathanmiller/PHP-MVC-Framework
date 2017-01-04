<?php

class Storage {

	protected $database;

	public function __construct() {	
		
		$this->database = new Mysql(
			DB_HOST,
			DB_USER,
			DB_PASS,
			DB_NAME
		);

	}

}