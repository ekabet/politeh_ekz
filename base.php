<?php
	abstract class Controller_base {
		abstract static function main($method, $id);
		
		protected static $answer = array('code', 'text', 'type');
		protected static $user;
		protected static $title;
		protected static $main;
		protected static $bc = [];
		protected static $css = array(
			CSS . 'my.css',
			CSS . 'font-awesome.css',
		);
		protected static $js = [];
		
		protected function render($page, $data = []) {
			extract($data);
			
			if (preg_match('/([a-z_\/0-9]*)\.?\w*/i', $page, $result)) {
				include_once VIEW . $result[1] . '.html';
			}
		}
		
		protected static function showPage(){
			if(!IS_AJAX) {
				self::render('main/head',   ['css'  => self::$css, 'title' => self::$title]);
				self::render('main/header', ['user' => self::$user, 'bc' => self::$bc]);
				
				foreach (self::$main as $page => $data) {
					self::render($page, $data);
				}
				
				self::render('main/footer');
				self::render('main/script', ['js' => self::$js]);
			}
			else {
				echo json_encode(self::$answer);
			}
		}
	}
?>