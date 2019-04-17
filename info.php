<?php
class Info extends Main{
	public function shownews() {
		$message['messages'] = News::showList();
		echo '<pre>';
		print_r($message);
		
	}
}