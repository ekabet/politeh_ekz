<?php
	// Реализация интерфейса Show
	interface Show {
		public function show();
	}
	// Реализация абстрактного класса Publication, реализующего интерфейса Show
	abstract class Publication implements Show {
		public $name;
		abstract function show();
	}
	// Реализация класса News, наследуемого от класса Publication
	class News extends Publication {
		public $name = 'Новость';
		public function show() {
			echo "<h4>{$this->name}</h4>";
		}
	}
	// Реализация класса Article, наследуемого от класса Publication
	class Article extends Publication {
		public $name = 'Статья';
		public function show() {
			echo "<h4>{$this->name}</h4>";
		}
	}
	// Реализация класса Announcement
	class Announcement {
		public $name = 'Анонс';
		public function anons() {
			echo "<h4>Анонсируем</h4>";
		}
	}
	//Наполняем массив публикаций объектами, производными от Publication
	$publications[] = new News();
	$publications[] = new News();
	$publications[] = new News();
	$publications[] = new Article();
	$publications[] = new Announcement();
	$publications[] = new Article();
	$publications[] = new Article();
	$publications[] = new Announcement();
	$publications[] = new Article();
	$publications[] = new Article();
	$publications[] = new Announcement();
	
	foreach ($publications as $publication) {
		if ($publication instanceof Show) {
			$publication->show();
		}
		else {
			echo 'Неизвестный тип статьи';
		}
	}
?>