<?php

class User extends Storage {

	private $_user_table = 'mvc_users';

	public function login($email) {
		Session::set('email', strtolower($email));
		Session::set('session_start', time());
		Session::set('session_expire', time() + 3600 * 24 * 3);
		Url::redirect(SITE_URL);
	}

	public function signup(array $data) {

		$email = strtolower($data['email']);
		$password = $data['password'];

		try {

			$this->database->query("INSERT INTO `{$this->_user_table}` (email, password, joined_at) VALUES (:email, :password, :joined_at)");
			$this->database->bindArray(array(
				':email' => $email,
				':password' => $password,
				':joined_at' => General::getDate()
			));
			$this->database->execute();

			Url::redirect(SITE_URL .'/login');

		} catch (PDOException $e) {

			echo $e->getMessage();

		}

	}

	public function getUser($email) {

		$email = trim(strtolower($email));

		$this->database->query("SELECT * FROM `{$this->_user_table}` WHERE email = :email");
		$this->database->bind(':email', $email);
		$result = $this->database->single();

		return ($result) ? $result : false;

	}

	public function getCurrentUser() {

		if (!empty(Session::get('email'))) {
			$user = array('email' => Session::get('email'));
			return $user;
		}

	}

}