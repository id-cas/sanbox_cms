<?php
class News {
	public string $type;
	public Objects $objects;
	public ObjectContent $objectContent;
	public Hierarchy $hierarchy;
	public self $module;

	public function __construct($type){
		$this->type = $type;
		$this->objects = Objects::getInstance();
		$this->objectContent = ObjectContent::getInstance();
		$this->hierarchy = Hierarchy::getInstance();
	}
}

class NewRubric extends News{
	public function __construct(){
		parent::__construct('news_rubric');
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