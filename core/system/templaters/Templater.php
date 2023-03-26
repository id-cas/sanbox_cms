<?php
class Templater implements iTemplater{
	private $dir;
	private $scope = [];

	public function __construct($dir){
		$this->layoutExists($dir);
		$this->dir = $dir;
	}

	private function layoutExists($path){
		if(!is_dir($path) && !file_exists($path)){
			throw new RuntimeException("Index root file {$path} doesn't exists.");
		}

		if (!is_readable($path)) {
			throw new RuntimeException("Cannot render template. PHP template file {$path} is not readable.");
		}
	}

	public function setScope($scope){
		$this->scope = $scope;
	}

	public function getScope(){
		return $this->scope;
	}

	private function functionGetOutput($fn){
		$args = func_get_args();
		unset($args[0]);
		ob_start();
		call_user_func_array($fn, $args);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private function display($template, $params = []){
		extract($params);
		include $template;
	}

	public function rn($template, $params = []){
		$path = $this->dir. '/'. $template. '.phtml';
		$this->layoutExists($path);
		return $this->functionGetOutput('self::display', $path, $params);
	}

	public function com($component, $method, $params = []){

	}
}