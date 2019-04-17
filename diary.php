<?php
	class Model_diary {
		public function __construct($id) {
			$cols = array(
				'diary_name'     => 'name',
				'diary_date'     => 'date',
				'diary_location' => 'location',
			);
			$where = array('diary_id' => $id);
			$info = Controller_DB::getObject('diary', $cols, $where);
			foreach ($info[0] as $key => $value) {
				$this->$key = $value;
			}
		}
		
		public static function getList() {
			$cols = array(
				'diary_id'       => 'id',
				'diary_name'     => 'name',
				'diary_date'     => 'date',
				'diary_location' => 'location',
			);
			
			return Controller_DB::getObject('diary', $cols);
		}
		
		public static function getNewDiary($info = array()) {
			if (!empty($info)) {
				return Controller_DB::insert('diary', $info);
			}
			else {
				return true;
			}
		}
		
		public static function editDiary($info = array(), $id = 0) {
			if (!empty($info)) {
				return Controller_DB::update('diary', $info, array('diary_id' => $id));
			}
			else {
				return true;
			}
		}
		
		public static function removeDiary($id = 0) {
			if ($id > 0) {
				return Controller_DB::delete('diary', array('diary_id' => $id));
			}
			else {
				return true;
			}
		}
	}
?>