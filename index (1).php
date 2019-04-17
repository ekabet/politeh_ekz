<?php
//require_once 'route.php';
function __autoload($class) {
	$dirs = array(
		__DIR__ . '\\',
		__DIR__ . '\controller\\',
		__DIR__ . '\model\\',
		__DIR__ . '\view\\'
	);
	// echo '<pre>';
	// print_r($dirs);
	foreach ($dirs as $dir) {
		if (file_exists($dir . $class . '.php')) {
			require_once($dir . $class . '.php');
		}
	}
}
Route::start();