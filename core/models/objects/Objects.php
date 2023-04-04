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

	public function getObjectsByType($type = ''): array {
		$objects = [];

		$query = "SELECT id, title FROM cms_objects WHERE 1=1";
		if(!empty($type)){
			$query .= " AND type='{$type}'";
		}

		$res = $this->connection->query($query);

		while($row = $res->fetch_assoc()) {
			$objects[$row['id']] = $row['title'];
		}

		return $objects;
	}

	public function getType($objId): string {
		$query = "SELECT type FROM cms_objects WHERE id={$objId}";
		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()) {
			return $row['type'];
		}

		return '';
	}

	public function getName($objId): string {
		$query = "SELECT title FROM cms_objects WHERE id={$objId}";
		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()) {
			return $row['title'];
		}

		return '';
	}

	public function getProperties($objId, $propNames): array {
		$type = $this->getType($objId);

		$props = implode(',', $propNames);

		$query = "SELECT {$props} FROM cms_object_{$type} WHERE obj_id={$objId}";
		$res = $this->connection->query($query);

		$values = [];
		if($row = $res->fetch_assoc()) {
			foreach ($propNames as $propName){
				$values[$propName] = $row[$propName];
			}

			return $values;
		}

		return [];
	}

	public function add($title, $type): int{
		$query = "INSERT INTO cms_objects (`title`, `type`) VALUES ('{$title}', '{$type}')";
		$this->connection->query($query);
		$insertId = mysqli_insert_id($this->connection);
		return $insertId ? $insertId : false;
	}


}
