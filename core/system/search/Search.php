<?php
class Search implements iSearch{
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
		$itext = mb_strtolower($itext);
		$itext = addslashes($itext);

		$query = "INSERT INTO cms_search (`obj_id`, `itext`) VALUES({$objId}, '{$itext}') ON DUPLICATE KEY UPDATE itext='{$itext}'";
		return !!$this->connection->query($query);
	}

	public function pull($str): array{
		$str = mb_strtolower($str);

		// TODO: Full-text search not work always correct
		// $query = "SELECT `obj_id` FROM `cms_search` WHERE MATCH (`itext`) AGAINST ('{$str}')";

		$query = "SELECT `obj_id` FROM `cms_search` WHERE itext like '%{$str}%'";
		$res = $this->connection->query($query);

		$objIdList = [];
		while($row = $res->fetch_assoc()) {
			$objIdList[] = $row['obj_id'];
		}

		return $objIdList;
	}
}