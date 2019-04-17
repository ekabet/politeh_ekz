<?php
	final class Controller_DB {
		public static $connect;
		
		public static function connect() {
			if (!self::$connect) {
				self::$connect = mysqli_connect(HOST, USER, PASS, DB);
				mysqli_set_charset(self::$connect, 'UTF8');
			}
		}
		
		private function __construct() {}
		private function __clone(){}
		private function __sleep(){}
		private function __wakeup(){}
		
		public static function getObject($table, $cols = array(), $where = array()) {
			self::connect();
			$query = "SELECT ";
			foreach ($cols as $col => $as) {
				$query.= ' `' . self::escape($col) . '`';
				if ($as) {
					$query.= ' AS `' . self::escape($as) . '`';
				}
				$query.= ',';
			}
			$query = trim($query, ',');
			$query.= ' FROM `' . self::escape($table) . '` WHERE 1 ';
			foreach ($where as $col => $val) {
				$query.= ' AND `' . self::escape($col) . '` = "' . self::escape($val) . '"';
			}
			$res = mysqli_query(self::$connect, $query);
			$array = array();
			while($obj = mysqli_fetch_object($res)) {
				$array[] = $obj;
			}
			return $array;
		}
		
		public static function escape($val) {
			return mysqli_real_escape_string(self::$connect, $val);
		}
	}