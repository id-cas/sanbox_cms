<?php
class Objects {
	private static $instance;
	private mysqli $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance()->get();
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new Objects();
		}
		return self::$instance;
	}

	public function getObjectsByType($type): array {
		$objects = [];

		$query = "SELECT id, title FROM cms_objects WHERE type='{$type}'";
		$res = $this->connection->query($query);

		while($row = $res->fetch_assoc()) {
			$objects[$row['id']] = $row['title'];
		}

		return $objects;
	}

	public function add($title, $type): int{
		$query = "INSERT INTO cms_objects (`title`, `type`) VALUES ({$title}, {$type})";
		$res = $this->connection->query($query);
		return $res->insert_id ? $res->insert_id : false;
	}


}
