<?php

function scanAllDirs($dir) {
	$result = [];
	foreach(scandir($dir, SCANDIR_SORT_DESCENDING) as $filename) {
		if ($filename[0] === '.') continue;
		$filePath = $dir . '/' . $filename;
		if (is_dir($filePath)) {
			foreach (scanAllDirs($filePath) as $childFilename) {
				$result[] = $filename . '/' . $childFilename;
			}
		} else {
			$result[] = $filename;
		}
	}
	return $result;
}

function includeClassesInDir($root){
	$dirs = scanAllDirs($root);
	foreach ($dirs as $dir){
		if(strpos($dir, 'bootstrap') !== false) continue;
		include_once WORKING_DIR. '/'. $root. '/'. $dir;
	}
}

function dump() {
	echo "<pre>";
	print_r(func_get_args());
	echo "</pre>";
}

// Load core
includeClassesInDir('core');
includeClassesInDir('components');

try {
	// Init config
	$config = Config::getInstance();

	// Init mysql connection
	$connection = MySqlConnection::getInstance();

	// Init template
	$tmpPath = $config->get('templates', 'path');
	$tmpName = $config->get('templates', 'name');
	$tmpl = new Templater(WORKING_DIR. '/'. $tmpPath. '/'. $tmpName. '/php');

	// Init Controller
	// TODO: Controller start page from specific hierarchy or components public api methods
	 $controller = Controller::getInstance();
	 $route = $controller->getRoute();

	 // START Templating
	 $indexFile = $config->get('templates', 'index');
	 echo $tmpl->rn($indexFile, [
	 	'component' => $route['component'],
		 'method' =>  $route['method'],
		 'params' =>  $route['params']
	 ]);
}
catch (Exception $e){
	echo $e->getMessage();
}

