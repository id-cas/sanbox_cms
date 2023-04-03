<?php
class News {
	public string $type;
	public Objects $objects;
	public ObjectContent $objectContent;
	public Hierarchy $hierarchy;

	public function __construct($type){
		$this->type = $type;
		$this->objects = Objects::getInstance();
		$this->objectContent = ObjectContent::getInstance();
		$this->hierarchy = Hierarchy::getInstance();
	}

	// TODO: Make less O(n^2)
	public function cleanTree($children, $objects): array{
		$tree = [];
		$tree['items'] = [];

		$objectIdList = array_keys($objects);

		foreach ($children['items'] as $item){
			if(!in_array($item['obj_id'], $objectIdList) && $item['obj_id'] !== 0){
				continue;
			}

			$subItems = [];
			if(count($item['items'])) {
				$subItems = $this->cleanTree(['items' => $item['items']], $objects);
			}

			// TODO: Root fix
			$tree['items'][] = [
				'obj_id' => $item['obj_id'],
				'page_id' => $item['page_id'],
				'title' => $item['obj_id'] ? $objects[$item['obj_id']] : 'Root',
				'url' => $item['obj_id'] ? $this->hierarchy->getUrl($item['page_id']) : '/',
				'items' => $subItems['items'] ?? []
			];
		}

		return $tree;
	}
}

class NewRubric extends News{
	public function __construct(){
		parent::__construct('news_rubric');
	}

	public function getList($rooId): array{
		// TODO: Must be optimazed with special cache instance
		$objects = $this->objects->getObjectsByType($this->type);
		$children = $this->hierarchy->getChildTree($rooId, true);

		return $this->cleanTree($children, $objects);
	}

	public function add($title, $parentId = 0){
		if($objId = $this->objects->add($title, $this->type)){
			if($hId = $this->hierarchy->addElement($parentId, $objId)){
				if($this->objectContent->add($this->type, ['title' => $title])){
					return $hId;
				}
			}
		}
		return false;
	}
}

class NewItem extends News{
	public function __construct(){
		parent::__construct('news_item');
	}

	public function add($title, $anons, $content, $parentId = 0){
		if($objId = $this->objects->add($title, $this->type)){
			if($hId = $this->hierarchy->addElement($parentId, $objId)){
				if($this->objectContent->add($this->type, ['title' => $title, 'anons' => $anons, 'content' => $content])){
					return $hId;
				}
			}
		}
		return false;
	}
}