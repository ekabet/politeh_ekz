<?php
	namespace A {
		$b = '\A\Test';
		class Test {
			function sayHello() {
				echo 'Hello';
			}
		}
		$test = new $b;
		$test->sayHello();
	}
?>