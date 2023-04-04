<?php
class Controller implements iController {
	public static $instance;
	private Hierarchy $hierarchy;
	private Objects $objects;

	public function __construct(){
		$this->hierarchy = Hierarchy::getInstance();
		$this->objects = Objects::getInstance();
	}

	public static function getInstance(): self {
		if (self::$instance === null) {
			self::$instance = new Controller();
		}
		return self::$instance;
	}

	public function getRoute(): array {
		$route = [
			'component' => '',
			'method' => '',
			'params' => [
				'args' => [],
				'query' => [],
				'data' => [],
				'page' => [
					'default' => false
				]
			]
		];

		// Decompose request data
		parse_str(urldecode($_SERVER['QUERY_STRING']), $query);
		$uri = array_filter(explode('/', $query['path'] ?? ''));
		$route['params']['page']['uri'] = $query['path'] ?? '/';

		if(isset($query['path'])){
			unset($query['path']);
		}

		// Is DEFAULT-HOME page
		// TODO: Also detect from hierarchy
		if(count($uri) === 0){
			$route['params']['page']['default'] = true;
			$route['params']['page']['query'] = $query;
			return $route;
		}

		// PRIORITY: First
		// API
		if(count($uri) === 3 && $uri[0] === 'api') {
			header('Content-Type: application/json; charset=utf-8');
			$componentName = 'Api'. ucfirst($uri[1]);

			try {
				$component = new $componentName;
				$method = mb_strtolower($uri[2]);
				echo json_encode(['result' => $component->$method()]);
			}
			catch (Exception $e){
				 echo json_encode(['error' => $e->getMessage()]);
			}

			exit();
		}

		// PRIORITY: Second
		// First two URI components is a COMPONENT + METHOD names, other - is system request params
		if(count($uri) === 2) {
			$component = mb_strtolower($uri[0]);
			$method = mb_strtolower($uri[1]);

			$componentName = 'Api'. ucfirst($component);
			$classMethods = get_class_methods($componentName);

			if(is_array($classMethods)){
				if(in_array($method, $classMethods)){
					$route['params']['component'] = $component;
					$route['params']['method'] = $method;
				}
				else {
					$route['params']['component'] = 'content';
					$route['params']['method'] = '404';
				}

				return $route;
			}
		}


		// PRIORITY: Third
		// Try to found page in HIERARCHY
		if(count($uri)){
			$page = $this->hierarchy->pageByUrlArr(array_reverse($uri));

			if(isset($page['obj_id'])){
				$type = $this->objects->getType($page['obj_id']);

				if(!empty($type)){
					$components = explode('_', $type);

					$route['params']['component'] = $components[0];
					$route['params']['method'] = $components[1];

					$route['params']['page']['id'] = $page['page_id'];
					$route['params']['page']['obj_id'] = $page['obj_id'];
					$route['params']['page']['parent_id'] = $page['parent_id'];

					return $route;
				}
			}
		}



		// 404
		$route['params']['component'] = 'content';
		$route['params']['method'] = '404';
		return $route;
	}
}