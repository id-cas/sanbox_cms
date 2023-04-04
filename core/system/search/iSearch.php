<?php
class Search {
	private static $instance;
	private mysqli $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance()->get();
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new Search();
		}
		return self::$instance;
	}

	// TODO: Make morpho-logic or AI search
	public function updateIndex($objId, $itext): bool{
		$query = "INSERT INTO cms_search (`obj_id`, `itext`) VALUES({$objId}, '{$itext}') ON DUPLICATE KEY UPDATE itext='{$itext}'";
		return !!$this->connection->query($query);
	}

	public function execute($str){
		$query = "SELECT `obj_id` FROM `cms_search` WHERE MATCH (`itext`) AGAINST ('{$str}')";
	}
}