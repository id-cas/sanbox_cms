<?php
class Controller implements iController {
	public static $instance;
	// private $hierarchy;
	public function __construct(){
		// TODO:
		// $hierarchy = new Hierarchy();
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
					'default' => true
				]
			]
		];

		// Decompose request data
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		$parsedQuery = parse_url($_SERVER['QUERY_STRING']);
		$query = isset($parsedQuery['query']) ? $parsedQuery['query'] : [];

		// Is DEFAULT-HOME page
		if(count($uri) === 0){
			$route['params']['page']['default'] = true;
			$route['params']['page']['query'] = $query;
			return $route;
		}

		// First two URI components is a COMPONENT + METHOD names, other - is system request params
		$apiMap = [
			'componentName_1' => ['method_1', 'method_2'],
			'componentName_2' => ['method_1', 'method_2'],
		];
		if(count($uri) > 1 && isset($apiMap[$uri[0]]) && isset($apiMap[$uri[0]][$uri[1]])){
			// TODO: Execute components API method and full fill data
			$route['params']['page']['data'] = [
				'component' => 'result'
			];
			return $route;
		}

		// Try to find pageId in hierarchy and return result with page type


		// 404
		$route['params']['component'] = 'content';
		$route['params']['method'] = '404';
		return $route;
	}
}