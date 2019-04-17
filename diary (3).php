<?php
	class Model_diary {
		public function __construct($id) {
			
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
	}
?>