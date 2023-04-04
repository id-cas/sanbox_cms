<?php
class Menu {
	public Objects $objects;
	public ObjectContent $objectContent;
	public Hierarchy $hierarchy;

	public function __construct(){
		$this->objects = Objects::getInstance();
		$this->objectContent = ObjectContent::getInstance();
		$this->hierarchy = Hierarchy::getInstance();
	}

	// TODO: Make less O(n^2)
	private function extendTree($children, $objects): array{
		$tree = [];
		$tree['items'] = [];

		foreach ($children['items'] as $item){

			$subItems = [];
			if(count($item['items'])) {
				$subItems = $this->extendTree(['items' => $item['items']], $objects);
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

	public function sitemap($rooId): array{
		// TODO: Must be optimazed with special cache instance
		$objects = $this->objects->getObjectsByType();
		$children = $this->hierarchy->getChildTree($rooId, true);

		return $this->extendTree($children, $objects);
	}
}

