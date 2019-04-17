<?php
	class Controller_diary extends Controller_base {
		public static function start($method, $id) {
			if (!$method) {
				self::showList();
			}
			else {
				self::$method($id);
			}
		}
		
		public static function showList() {
			$arrDiary = Model_diary::getList();
			self::view('diaryList', array('arrDiary' => $arrDiary));
		}
		
		public static function add() {
			if (empty($_POST)) {
				self::view('addForm');
			}
			else {
				if (Model_diary::getNewDiary($_POST)) {
					header('Location: /' . BASE . 'diary');
				}
				else {
					echo 'Возникла проблема при создании записи!';
				}
			}
		}
		public static function update($id) {
			if (empty($_POST)) {
				$diary = new Model_diary($id);
				self::view('editForm', array('diary' => $diary));
			}
			else {
				if (Model_diary::editDiary($_POST, $id)) {
					header('Location: /' . BASE . 'diary');
				}
				else {
					echo 'Возникла проблема при обновлении записи!';
				}
			}
		}
		public static function remove($id = 0) {
			if (Model_diary::removeDiary($id)) {
				header('Location: /' . BASE . 'diary');
			}
			else {
				echo '<p>Не удалось удалить запись!</p>';
			}
		}
	}
?>