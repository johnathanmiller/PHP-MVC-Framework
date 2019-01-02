<?php

class User {

	protected $db;

	protected $_sql_users = 'mvc_users';

	public function __construct()
	{
		$this->db = new MySQL(
			getenv('PDO_HOST'),
			getenv('PDO_PORT'),
			getenv('PDO_USER'),
			getenv('PDO_PASS'),
			getenv('PDO_NAME')
		);
	}

	/**
	 * Get
	 * 
	 * @since 2.0.0
	 * @access public
	 * 
	 * @param string $email User's email
	 * @param array $fields Array of fields to retrieve
	 * @return array|null
	 */
	public function get(string $email, array $fields) : ?array
	{
		$email = Sanitize::email($email);

        $this->db->query("SELECT " . implode(', ', $fields) . " FROM `{$this->_sql_users}` WHERE email = :email");
        $this->db->bind(':email', $email);
		$user = $this->db->single();

        return (!empty($user)) ? $user : null;
	}
	
	/**
	 * Login
	 * 
	 * @since 2.0.0
	 * @access public
	 * 
	 * @param string $email User's email
	 * @param string $password User's password
	 * @return bool
	 */
	public function login(string $email, string $password) : bool
	{
		if ($user = $this->get($email, ['password'])) {
			if (password_verify($password, $user['password'])) {
				Session::set('email', $email);
				Session::set('session_start', time());
				Session::set('session_expire', time() + (60 * 60 * 24 * 7));

				return true;
			}
		}

		return false;
	}

	/**
	 * Signup
	 * 
	 * @since 2.0.0
	 * @access public
	 * 
	 * @param array $data Associative array of user data
	 * @return bool
	 */
	public function signup(array $data) : bool
	{
		if (isset($data['email']) && isset($data['password'])) {
			$data['email'] = Sanitize::email($data['email']);
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['joined_at'] = Date::inISO();

			$fields = array_keys($data);

			$this->db->query("INSERT INTO `{$this->_sql_users}` (" . implode(', ', $fields) . ") VALUES (:" . implode(', :', $fields) . ")");
			$this->db->bindArray($data);
			$this->db->execute();

			return true;
		}

		return false;
	}

}