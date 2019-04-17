<?php
class Route {
	public static function start() {
		//контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';

		$route = $_SERVER['REQUEST_URI']; //полный адрес, по которому обратился пользователь
		$url = str_replace('myoop/', '', trim($route, '/')); //обрезаем
		$info = explode('/', $url); //разбиваем на массив
		// print_r($info);
		//получаем имя контроллера
		if (!empty($info[1])) {
			$controller_name = $info[1];
		}
		//получаем имя метода
		if (!empty($info[2])) {
			$action_name = $info[2];
		}
		// $controller_file = strtolower($controller_name).'.php';
		// $controller_path = "controller/".$controller_file;
		// if(file_exists($controller_path)) {
		// 	include $controller_path;
		// } else {
		// 	die("запрашиваемой страницы не существует");
		// }
		//наличие класса в файле
		if(class_exists($controller_name)) {
			$controller = new $controller_name;
			$action = $action_name;
		} else {
			die("запрашиваемой страницы не существует");
		}
		//наличие метода в классе
		if(method_exists($controller, $action)) {
			$controller->$action();
		} else {
			die("запрашиваемой страницы не существует");
		}
	}
}
// Route::start();