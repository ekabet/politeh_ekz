<?php
	# Настройки БД
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DB',   'oop');
	
	# Определение путей
	// Корневая папка
	define('DIR',  pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME) . '/');
	// Используемый протокол
	define('SCHEME', (is_null($_SERVER['REQUEST_SCHEME']) ? 'http' : $_SERVER['REQUEST_SCHEME']) . '://');
	// Имя сервера (домена)
	define('SERVER', $_SERVER['SERVER_NAME'] . '/');
	// Информация о поддомене
	define('SUBSERVER', pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) . '/');
	// Путь к корню ресурса
	define('MAIN',  SCHEME . str_replace('//', '/', SERVER . SUBSERVER));
	// Проверяем, был ли запрос сделан при помощи AJAX
	define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']));
	
	#Основная секция
	define('MODEL',      DIR  . 'model/');
	define('CONTROLLER', DIR  . 'controller/');
	define('VIEW',       DIR  . 'view/');
	define('LOG',        DIR  . 'log/');
	define('CSS',        MAIN . 'css/');
	define('JS',         MAIN . 'js/');
	define('IMG',        MAIN . 'img/');
	define('FONT',       MAIN . 'fonts/');
	define('AJAX',       MAIN . 'ajax/');
	
	# Установка русской локали и московского времени
	setlocale(LC_ALL, 'rus_rus');
	date_default_timezone_set('Europe/Moscow');
?>