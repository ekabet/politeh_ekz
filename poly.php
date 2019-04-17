<?
	class User {
	private $_name, $_surname;
	protected $age;
	
	public function __construct ($name, $surname) {
		if (!is_string($name) || strlen($name) < 2) {
			exit("Неверное значение имени!");
		}
		$this->_name = $name;
		
		if (!is_string($surname) || strlen($surname) < 2) {
			exit("Неверное значение фамилии!");
		}
		$this->_surname = $surname;
	}
	
	public function __destruct() {
		echo "<p>Объект с именем '{$this->_name}' уничтожен</p>";
	}
	
	public function __set($property, $value) {
		$this->$property = $value;
	}
	
	public function __get($property) {
		if ($property == '_name') {
			return 'Данный атрибут закрыт!';
		}
		else
		return isset($this->$property) ? $this->$property : 'Атрибута ' . $property . ' не существует';
	}
	
	function __call($method, $params) {
		$this->sayHello();
	}
	
	private function sayHello() {
		echo "Привет {$this->getName()}<br/>";
	}
	public function getName() {
		return $this->_name;
	}
}

	$objUser = new User('Рома', 'Лунев');
	$objUser->age = 27;
	$objUser->sayHello('1', '2', '3');
	echo $objUser->_name;
	echo $objUser->group;
	
	echo '<pre>';
	print_r($objUser);
	//$objUser1->_name = 'Роман';
	//$objUser1->surname = 'Лунев';
	//$objUser1->sayHello();

	
?>
