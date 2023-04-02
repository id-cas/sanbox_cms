<?php
class ObjectContent {
	private static $instance;
	private MySqlConnection $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance();
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
			$keys[] = '`'. $key. '`';
			$values[] = '`'. $value. '`';
		}

		$keysStr = implode(',', $keys);
		$valuesStr = implode(',', $values);

		$query = "INSERT INTO cms_object_type_{$type} ({$keysStr}) VALUES ({$valuesStr})";
		$res = $this->connection->query($query);
		return $res->insert_id ? $res->insert_id : false;
	}


}
