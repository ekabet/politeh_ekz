<?php
	trait Guest {
		function sayHello() {
			echo "Здравствуй гость! Зарегистрируйся.<br>";
		}
	}
	trait User {
		function sayHello() {
			echo "Здравствуй " . $this->getName() . " !<br>";
		}
		function getName() {
			return "Пользователь";
		}
	}
	trait Admin {
		function sayHello() {
			echo "Добро пожаловать!<br>";
		}
	}
	class realUser {
		use User, Guest, Admin {
			User::sayHello insteadof Guest, Admin;
			Guest::sayHello as helloGuest;
			Admin::sayHello as helloAdmin;
		}
	}
	$user = new realUser;
	$user->sayHello();
	$user->helloGuest();
	$user->helloAdmin();
?>