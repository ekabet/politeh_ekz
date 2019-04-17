<?php
class User {

	private $_id;
	private $_mode;
	private $_fullname;

	private function __construct($id) {
		
		$sql = '
			SELECT `mode`, CONCAT(`name`, " ", `surname`) AS `name`
			FROM `user`
			WHERE `id_user` = ' . $id . ';
		';
		$info = DB::getRow($sql);
		if ($info) {
			$this->_id = $id;
			$this->_mode = $info['mode'];
			$this->_fullname = $info['name'];
		}
	}

	//авторизация
	static function signIn($login, $pass) {

		$sql = '
			SELECT `id_user` AS `id`
			FROM `user`
			WHERE `login` = "' . DB::escape($login) . '"
			AND `pass` = "' . $pass . '";
		';
		$id = DB::getValue($sql);
		return $id ? new self($id) : false;
	}
	function signUp() {}
	function remove () {}
	function chMod () {}
	function logOut() {}
}
?>