<?php

/**
 *
 * Example model for accessing data
 *
 */


class User extends Storage {

	private $_user_table = 'tablename';

	public function getUser($email) {

		$email = trim(strtolower($email));

		$this->database->query("SELECT * FROM `{$this->_user_table}` WHERE email = :email");
		$this->database->bind(':email', $email);
		$result = $this->database->single();

		return ($result) ? $result : false;

	}

}