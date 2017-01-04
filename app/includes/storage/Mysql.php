<?php

class Mysql {

	private $dbhandler;
	private $error;

	private $stmt;

	public function __construct($host, $user, $pass, $name) {
		$dsn = 'mysql:host='. $host .';port=3306;dbname='. $name .';charset=utf8';
		$options = array(
			\PDO::ATTR_PERSISTENT => false,
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbhandler = new \PDO($dsn, $user, $pass, $options);
		} catch (Exception $e) {
			$this->error = $e->getMessage();
		}
	}

	public function query($query) {
		$this->stmt = $this->dbhandler->prepare($query);
	}

	public function bind($param, $value, $type = null) {
		if (is_null($type)) {
			switch (true) {
				case is_numeric($value):
					$type = \PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = \PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = \PDO::PARAM_NULL;
					break;
				default:
					$type = \PDO::PARAM_STR;
			}
		}

		$this->stmt->bindValue($param, $value, $type);
	}

	public function bindArray($array) {
		foreach ($array as $k => $v) {
			$this->bind($k, $v);
		}
	}

	public function execute() {
		return $this->stmt->execute();
	}

	public function resultSet() {
		$this->execute();
		return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function single() {
		$this->execute();
		return $this->stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function rowCount() {
		return $this->stmt->rowCount();
	}

	public function lastInsertId() {
		return $this->dbhandler->lastInsertId();
	}

	public function beginTransaction() {
		return $this->dbhandler->beginTransaction();
	}

	public function endTransaction() {
		return $this->dbhandler->commit();
	}

	public function cancelTransaction() {
		return $this->dbhandler->rollBack();
	}

	public function debugDumpParams() {
		return $this->stmt->debugDumpParams();
	}

}