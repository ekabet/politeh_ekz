<?php
	class Controller_news extends Controller_base {
		static function main($method, $id = 0) {
			self::$bc[] = ['url' => MAIN . 'news/', 'name' => 'Новости'];
			
			switch($method) {
				case 'remove':
					self::remove();
					break;
				default: self::showList();
			}
			
			self::showPage();
		}
		
		private static function showList() {
			self::$title = 'Новости';
			self::$main = [
				'news/list' => ['news' => Model_news::getList()],
			];
		}
		
		private static function remove() {
			if (!IS_AJAX) {
				self::$title = 'Ошибка';
				self::$bc[] = ['url' => MAIN . '#', 'name' => 'Ошибка'];
				self::$main = [
					'code/404' => [],
				];
			}
			else {
				if (isset($_POST['id'])) {
					// Производим процесс удаления
					self::$answer['code'] = 0;
					self::$answer['type'] = 'success';
					self::$answer['text'] = 'Запись успешно удалена';
				}
				else {
					self::$answer['code'] = 1;
					self::$answer['type'] = 'info';
					self::$answer['text'] = 'Не указан ID новости';
				}
			}
		}
	}
?>