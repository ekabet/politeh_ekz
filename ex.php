<?php
	// Создаем класс Guest
	class Guest {
		// Задаем статическое свойство $id
		public static $id = 0;
		
		// Определяем статические методы sayHello и getId
		public static function sayHello() {
			echo "Здравствуй гость! Зарегистрируйся.";
		}
		public static function getId() {
			echo self::$id;
		}
	}
	
	Guest::sayHello();
	Guest::getId();
	$guest = new Guest;
	$guest::sayHello();
?>
