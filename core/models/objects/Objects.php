<?php
class Objects {
	private static $instance;
	private MySqlConnection $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance();
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new Objects();
		}
		return self::$instance;
	}

	public function add($title, $type){
		$query = "INSERT INTO cms_objects (`title`, `type`) VALUES ({$title}, {$type})";
		$res = $this->connection->query($query);
		return $res->insert_id ? $res->insert_id : false;
	}


}
