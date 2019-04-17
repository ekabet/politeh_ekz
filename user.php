<?php
	class Model_User {
		
		public static function getByToken() {
			if(isset($_COOKIE['PHPSESSID']) AND isset($_SESSION['token'])) {
				return DB::getRow('
					SELECT 
						user_id    AS id,
						user_rule  AS rule,
						user_login AS login
					FROM users 
					WHERE user_session = "' . DB::escape($_COOKIE['PHPSESSID']) . '"
					AND   user_token   = "' . DB::escape($_SESSION['token']) . '";
				');
			}
			else {
				return false;
			}
		}
		
		public static function getIdByAuth($login, $pass) {
			return DB::getValue('
				SELECT user_id 
				FROM users 
				WHERE user_login = "' . DB::escape($login) . '"
				AND   user_pass  = "' . md5($pass) . '";
			');
		}
	}
?>