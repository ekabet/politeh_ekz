<?php
	class DB {
		static private $_connect;
		
		static function connect() {
			self::$_connect = mysqli_connect(HOST, USER, PASS, DB);
			mysqli_set_charset(self::$_connect, 'utf8');
		}
		
		static function getValue($query) {
			self::connect();
			
			$info = mysqli_query(self::$_connect, $query);
			if (mysqli_num_rows($info)) {
				$data = mysqli_fetch_array($info);
				return $data[0];
			}
			else {
				return null;
			}
		}
		
		static function getRow($sql) {
			self::connect();
			
			$info = mysqli_query(self::$_connect, $sql);
			if ($code = mysqli_errno(self::$_connect)) {
				//$text = mysqli_error(self::$_connect);
				//Err::logDbError ($code, $text, $sql);
				return false;
			}
			else {
				if (mysqli_num_rows($info)) {
					return mysqli_fetch_assoc($info);
				}
				else {
					return null;
				}
			}
		}
		
		static function getArray($sql) {
			self::connect();
			
			$info = mysqli_query(self::$_connect, $sql);
			if ($code = mysqli_errno(self::$_connect)) {
				//$text = mysqli_error(self::$_connect);
				//Err::logDbError ($code, $text, $sql);
				return false;
			}
			else {
				if (mysqli_num_rows($info)) {
					return mysqli_fetch_all($info, MYSQLI_ASSOC);
				}
				else {
					return array();
				}
			}
		}
		
		static function update($arr = array()) {
			self::connect();
			
			extract($arr, EXTR_OVERWRITE);

			if (!isset($table) OR !isset($values) OR !isset($where)) {
				return false;
			}
			else {
				$query = 'UPDATE ' . DB::escape($table) . ' SET ';
				
				foreach($values as $column => $value) {
					$query.= DB::escape($column) . ' = "' . DB::escape($value) . '",';
				}

				$query = trim($query, ',');
				$query.= ' WHERE 1 ';

				foreach ($where as $col => $val) {
					$query.= ' AND ' . DB::escape($col) . ' = ' . DB::escape($val);
				}
				
				mysqli_query(self::$_connect, $query);

				if (mysqli_errno(self::$_connect)) {
					//$data = debug_backtrace();
					//writeErrLog($data[0]['file'], $data[0]['line'], mysqli_errno($db), mysqli_error($db), $query);
					return false;
				}
				else {
					return true;
				}
			}
		}
		
		static function escape($str) {
			self::connect();
			return mysqli_real_escape_string(self::$_connect, $str);
		}
	}
?>