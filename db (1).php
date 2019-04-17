<?php
class DB {
	static private $_instance;
	public $connect;

	private function __construct() {
		$this->connect = mysqli_connect('localhost', 'root', '', 'oop');
		mysqli_set_charset($this->connect, 'utf8');
	}

	static public function connect() {
		// self::$_connect = mysqli_connect($host, $user, $pass, $db);
		// mysqli_set_charset(self::$_connect, 'utf8');
		if (self::$_instance === null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	private function __clone(){}
	private function __sleep(){}
	private function __wakeup(){}

	static function getValue($query) {
		$db = self::connect();
		if ($db->connect) {
			$info = mysqli_query($db->connect, $query);
			if (mysqli_num_rows($info)) {
				$data = mysqli_fetch_array($info);
				return $data[0];
			} else {
				return null;
			}
		} else {
			return false;
		}
	}

	static function getRow($query) {
		$db = self::connect();
		if ($db->connect) {
			$wtf = mysqli_query($db->connect, $query);

			if ($code = mysqli_errno($db->connect)) {
				$text = mysqli_error($db->connect);
				Err::logDbError($code, $text, $wtf);
			} else {
				if (mysqli_num_rows($wtf)) {
					return mysqli_fetch_assoc($wtf);
				} else {
					return null;
				}
			}

		} else {
			return false;
		}
	}

	static function getAll($sql) {
		$db = self::connect();
		if ($db->connect) {
			$info = mysqli_query($db->connect, $sql);
			while ($infoOne = $info->fetch_assoc()) {
				$messages[] = $infoOne;
			}
			return $messages;
		}else {
			return false;
		}
	}

	static function escape($str) {
		$db = self::connect();
		return $db->connect ? mysqli_real_escape_string(self::$_connect, $str) : false;
	}
}
// $con = DB::connect();
// echo '<pre>';
// print_r($con->connect);
// echo '<br>';
// $con2 = DB::connect();
// print_r($con2->connect);
?>