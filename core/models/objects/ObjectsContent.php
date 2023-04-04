<?php
class ObjectContent {
	private static $instance;
	private mysqli $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance()->get();
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new ObjectContent();
		}
		return self::$instance;
	}

	public function add($type, $props){
		$keys = [];
		$values = [];
		foreach ($props as $key => $value) {
			$value = addslashes($value);

			$keys[] = "`{$key}`";
			$values[] = "'{$value}'";
		}

		$keysStr = implode(',', $keys);
		$valuesStr = implode(',', $values);

		$query = "INSERT INTO cms_object_{$type} ({$keysStr}) VALUES ({$valuesStr})";
		$this->connection->query($query);
		$insertId = mysqli_insert_id($this->connection);
		return $insertId ? $insertId : false;
	}


}
