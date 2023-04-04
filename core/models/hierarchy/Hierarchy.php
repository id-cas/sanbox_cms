<?php
class Hierarchy {
	private static $instance;
	public mysqli $connection;

	public function __construct(){
		$this->connection = MySqlConnection::getInstance()->get();
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
	private function getMaxOrd($parentId): int{
		$query = "SELECT MAX(ord) as ord FROM cms_hierarchy WHERE parent_id={$parentId}";
		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()) {
			return intval($row['ord']) + 1;
		}

		return 0;
	}

	private function uniqUri($title, $parentId, $objId): string{
		$utils = new Utils();
		$uri = $utils->translit($title);

		$query = "SELECT obj_id, uri FROM cms_hierarchy WHERE parent_id={$parentId}";
		$res = $this->connection->query($query);

		if(empty($res)) {
			return $uri;
		}

		$dig = [];
		while ($row = $res->fetch_assoc()) {
			$childUri = $row['uri'];

			if ($row['obj_id'] == $objId) {
				return $childUri;
			}

			if (preg_match("/^$uri$|^$uri" . "_\d+$/", $childUri, $m)) {

				if (preg_match("/_\d+$/", $childUri, $postfix)) {
					$dig[] = intval(str_replace('_', '', $postfix[0]));
				} else {
					$dig[] = 0;
				}
			}
		}

		$uriPostfix = '';
		if (count($dig)) {
			$maxDig = max($dig);
			$uriPostfix = "_" . ($maxDig + 1);
		}

		return $uri. $uriPostfix;
	}

	public function addElement($title, $parentId, $objId, $isActive = 1, $ord = null): int{
		$uniqUri = $this->uniqUri($title, $parentId, $objId);
		$ord = empty($ord) ? $this->getMaxOrd($parentId) : $ord;
		$query = "INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `is_active`, `ord`, `uri`) VALUES ({$parentId}, {$objId}, {$isActive}, {$ord}, '{$uniqUri}')";
		$this->connection->query($query);
		$insertId = mysqli_insert_id($this->connection);
		return $insertId ? $insertId : false;
	}


	private function getUrlComponent($page_id): array{
		$query = "SELECT parent_id, uri FROM cms_hierarchy WHERE id={$page_id} ORDER BY ord ASC";
		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()){
			return [
				'parent_id' => $row['parent_id'],
				'uri' => $row['uri']
			];
		}

		return [];
	}

	public function getUrl($page_id): string{
		$components = [];
		while($component = $this->getUrlComponent($page_id)){
			$components[] = $component['uri'];
			$page_id = $component['parent_id'];
		}
		$components = array_reverse($components);
		return '/'. implode('/', $components). '/';
	}

	public function getChildTree($parentId = 0, $includeRoot = false): array {
		return ['items' => $this->getChildren($parentId, $includeRoot)];
	}

	private function getChildren($parentId = 0, $includeRoot = false): array {
		$tree = [];

		if($includeRoot && $parentId === 0){
			$tree[] = [
				'page_id' => 0,
				'obj_id' => 0,
				'uri' => '/',
				'items' => $this->getChildren()
			];

			return $tree;
		}

		if($includeRoot){
			$query = "SELECT id AS hid, obj_id, uri FROM cms_hierarchy WHERE id={$includeRoot} ORDER BY ord ASC";
			$res = $this->connection->query($query);
			if($row = $res->fetch_assoc()) {
				$tree[] = [
					'page_id' => $row['hid'],
					'obj_id' => $row['obj_id'],
					'uri' => $row['uri'],
					'items' => $this->getChildren($row['hid'])
				];
			}

			return $tree;
		}

		$query = "SELECT id AS hid, obj_id, uri FROM cms_hierarchy WHERE parent_id={$parentId} ORDER BY ord ASC";
		$res = $this->connection->query($query);

		while($row = $res->fetch_assoc()) {
			$tree[] = [
				'page_id' => $row['hid'],
				'obj_id' => $row['obj_id'],
				'uri' => $row['uri'],
				'items' => $this->getChildren($row['hid'])
			];
		}

		return $tree;
	}


	public function pageByUrlArr($uriArr): array{
		$query = '';

		for ($i = 0; $i < count($uriArr); $i++){
			$uri = $uriArr[$i];

			if($i === 0){
				$query = "SELECT h{$i}.id AS page_id, h{$i}.obj_id, h{$i}.parent_id FROM cms_hierarchy h{$i} WHERE h{$i}.uri='{$uri}' __EXISTS__";
			}
			else {
				$j = $i - 1;
				$sub = "AND EXISTS (SELECT h{$i}.id FROM cms_hierarchy h{$i} WHERE h{$j}.parent_id=h{$i}.id AND h{$i}.uri='{$uri}' __EXISTS__) ";
				$query = preg_replace('/__EXISTS__/', $sub, $query);
			}
		}
		$query = preg_replace('/__EXISTS__/', '', $query);



		$res = $this->connection->query($query);

		if($row = $res->fetch_assoc()) {
			return [
				'page_id' => $row['page_id'],
				'parent_id' => $row['parent_id'],
				'obj_id' => $row['obj_id']
			];
		}

		return [];
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
