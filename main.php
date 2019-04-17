<?php
	session_start();
	include_once 'config.php';
	include_once 'function.php';
	include_once 'controller/db.php';
	include_once 'controller/route.php';
	function __autoload($class) {
		$class = str_replace('_', '/', $class) . '.php';
		if (file_exists($class)) {
			include_once $class;
		}
	}
	Route::start($_SERVER['REDIRECT_URL']);
?>
