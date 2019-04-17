<?php
include_once 'content.php';

class Albums extends Content{
	private $dir, $photoList;
	protected $type = 'albums';

	function save() {echo 'я сохраняю!';}
	function update() {}
	function delete() {}
	function show() {}
	function showList() {}
}

DB::connect('localhost', 'root', '', 'oop');
$album = new Albums(1);
$album->save();