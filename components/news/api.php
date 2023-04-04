<?php
class ApiNews extends Api {
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
		return $rubric->add($title, $content, $parents);

		// TODO: Call search reindex event
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