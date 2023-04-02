<?php
class ApiNews extends Api {
	public function add_rubric(){
		$title = getRequestParam('title');
		$parentId = getRequestParam('parent_id');

		if(empty($title) || empty($parentId)){
			return false;
		}

		$rubric = new NewRubric();
		return $rubric->add($title, $parentId);

		// TODO: Call search reindex event
	}

	public function add_virtual_rubric(){
		$hId = getRequestParam('h_id');
		$parentId = getRequestParam('parent_id');
		return 'Hello';
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
		return $rubric->add($title, $anons, $content, $parentId);

		// TODO: Call search reindex event
	}

	public function add_virtual_item($hId, $parentId){
	}
}