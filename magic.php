<?php
	class User {
		public $name  = '';
		public $type  = 'user';
		private $_link;
		public function __construct($name) {
			$this->name = $name;
		}
		public function connect() {
			$this->_link = mysqli_connect('localhost', 'root', '', 'test');
		}
		public function __sleep() {
			return array('name', 'type');
		}
		public function __wakeup() {
			$this->connect();
		}
	}
	$user = new User('test');
	$store = serialize($user);
	$test = unserialize($store);
?>