<?php
class Hierarchy {
	private static $instance;
	private MySqlConnection $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance();
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new Hierarchy();
		}
		return self::$instance;
	}

	/**
	 * Get maximum order number of element in hierachy relation with one parent
	 * @param $parentId
	 * @return int
	 */
	private function getMaxOrd($parentId){
		$query = "SELECT MAX(ord) as ord FROM cms_hierarchy WHERE parent_id={$parentId})";
		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()) {
			return intval($row['ord']) + 1;
		}

		return 0;
	}

	public function addElement($parentId, $objId, $isActive = 1, $ord = null){
		$ord = empty($ord) ? $this->getMaxOrd($parentId) : $ord;
		$query = "INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `is_active`, `ord`) VALUES ({$parentId}, {$objId}, {$isActive}, {$ord})";
		$res = $this->connection->query($query);
		return $res->insert_id ? $res->insert_id : false;
	}

	public function getObjectId($hId){
		$query = "SELECT obj_id FROM cms_hierarchy WHERE id={$hId})";
		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()) {
			return $row['obj_id'];
		}

		return false;
	}

	public function deleteElement($hId){
		$query = "DELETE FROM cms_hierarchy WHERE id={$hId})";
		$this->connection->query($query);
	}
}
