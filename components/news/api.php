<?php
class ApiNews extends Api {
	public Search $search;

	public function __construct(){
		$this->search = Search::getInstance();
	}

	public function add_rubric(){
		$title = getRequestParam('title');
		$content = getRequestParam('content');
		$parents = getRequestParam('parents');

		if(empty($title)){
			return ['error' => 'Empty title field.'];
		}

		if(empty($content)){
			return ['error' => 'Empty content field.'];
		}

		if(!is_array($parents) || !count($parents)) {
			$parents[] = 0;
		}

		$rubric = new NewRubric();
		$objId = $rubric->add($title, $content, $parents);

		// TODO: Refactor search reindex event - Observer Pattern
		$this->search->updateIndex($objId, "{$title} {$content}");

		return $objId;
	}


	public function add_item(){
		$title = getRequestParam('title');
		$anons = getRequestParam('anons');
		$content = getRequestParam('content');
		$parentId = getRequestParam('parent_id');

		if(empty($title) || empty($parentId)){
			return false;
		}

		$rubric = new NewItem();
		$objId = $rubric->add($title, $anons, $content, $parentId);

		// TODO: Refactor search reindex event - Observer Pattern
		$this->search->updateIndex($objId, "{$title} {$anons} {$content}");

		return $objId;
	}
}