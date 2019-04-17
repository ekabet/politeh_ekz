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
	}
?>