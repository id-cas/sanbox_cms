<?php
class MySqlConnection implements iMySqlConnection {
	private static $instance;
	private mysqli $connection;

	public function __construct(){
		$conf = Config::getInstance()->get('mysql');

		$this->connection = new mysqli(
			$conf['host'],
			$conf['user'],
			$conf['password'],
			$conf['database'],
			$conf['port'],
			$conf['persistent']);

		// Check connection
		if ($this->connection->connect_errno) {
			throw new RuntimeException("Failed to connect to MySQL: " . $this->connection->connect_error);
			exit();
		}
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new MySqlConnection();
		}
		return self::$instance;
	}

	public function get(): mysqli{
		return $this->connection;
	}
}
