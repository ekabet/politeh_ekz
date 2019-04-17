<?php
class DB {
	static private $_connect;

	static function connect($host, $user, $pass, $db) {
		self::$_connect = mysqli_connect($host, $user, $pass, $db);
		mysqli_set_charset(self::$_connect, 'utf8');
	}

	static function getValue($query) {
		if (self::$_connect) {
			$info = mysqli_query(self::$_connect, $query);
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
		if (self::$_connect) {
			$wtf = mysqli_query(self::$_connect, $query);

			if ($code = mysqli_errno(self::$_connect)) {
				$text = mysqli_error(self::$_connect);
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

	static function escape($str) {
		return self::$_connect ? mysqli_real_escape_string(self::$_connect, $str) : false;
	}
}
?>