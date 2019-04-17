<?php
	class Controller_index extends Controller_base {
		static function main() {
			$user = Model_User::getByToken();
			if ($user) {
				self::render('index/main', array('user' => $user));
			}
			else {
				self::render('index/auth');
			}
		}
		
		static function auth() {
			$answer['error'] = 1;
			$answer['text']  = 'Ошибка обращения к серверу';
			$answer['type']  = 'danger';
			
			if (isset($_POST['login']) AND isset($_POST['pass'])) {
				$id = Model_user::getIdByAuth($_POST['login'], $_POST['pass']);
				if ($id) {
					$answer['error'] = 0;
					$session = $_COOKIE['PHPSESSID'];
					$token   = getHash();
					$_SESSION['token'] = $token;
					
					$data['table']  = 'users';
					$data['values'] = array(
						'user_session' => $session,
						'user_token'   => $token,
					);
					$data['where'] = array('user_id' => $id);
					
					if (DB::update($data)) {
						$answer['text']  = 'Добро пожаловать';
						$answer['type']  = 'success';
					}
					else {
						$answer['text']  = 'Ошибка обрашения к серверу базы данных';
						$answer['type']  = 'danger';
					}
				}
				else {
					$answer['text']  = 'Неверная связка логин/пароль';
					$answer['type']  = 'warning';
				}
			}
			else {
				$answer['text']  = 'Укажите логин/пароль';
				$answer['type']  = 'warning';
			}
			
			echo json_encode($answer);
		}
		
		static function logout() {
			unset($_SESSION['token']);
			unset($_COOKIE['PHPSESSID']);
			
			header('Location:' . MAIN);
		}
	}
?>