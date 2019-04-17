<?php
	class Model_news {
		public static function getList () {
			return DB::getArray('
				SELECT 
					id,
					name,
					date
				FROM news
				ORDER BY date;
			');
		}
	}
?>