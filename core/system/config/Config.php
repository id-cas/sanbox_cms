<?php
class Config implements iConfig {
	private static $instance;
	private $configData;

	public function __construct(){
		$path = WORKING_DIR. '/config.ini';

		if(!file_exists($path)){
			throw new RuntimeException("config.ini file {$path} doesn't exists.");
		}

		$this->configData = parse_ini_file($path, true);
	}

	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new Config();
		}

		return self::$instance;
	}

	public function get($section, $param = ''){
		if(empty($param)) {
			return $this->configData[$section];
		}

		if(!isset($this->configData[$section])){
			return null;
		}

		return $this->configData[$section][$param];
	}
}
