<?php
include_once 'text.php';

class News extends Text {
	protected $author;
	protected $type = 'news';

	function save() {}
	function update() {}
	function delete() {}
	function show() {}
	function showList() {}
}

DB::connect('localhost', 'root', '', 'oop');
$news = new News(1);
echo '<pre>';
print_r($news);