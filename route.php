<?php
	class Route extends Controller_base {
		private static $patterns = array(
			'Controller_index' => [
				'#^' . SUBSERVER . '/?$#',
				'#^' . SUBSERVER . 'index/?$#',
				'#^' . SUBSERVER . 'index/(auth)/?$#',
				'#^' . SUBSERVER . 'index/(enter)/?$#',
				'#^' . SUBSERVER . 'index/(logout)/?$#',
				'#^' . SUBSERVER . '(logout)/?$#',
			],
			'Controller_news' => [
				'#^' . SUBSERVER . 'news/?$#',
				'#^' . SUBSERVER . 'news/(remove)/?$#',
			],
			'Error' => [
				'#^.*$#',
			],
		);
		
		public static function start($url) {
			foreach (self::$patterns as $class => $list) {
				foreach ($list as $pattern) {
					if (preg_match($pattern, $url, $info)) {
						$method = isset($info[1]) && $info[1] !== '' ? htmlspecialchars($info[1]) : 'list';
						$id     = isset($info[2]) ? (int)$info[2] : 0;
						break 2;
					}
				}
			}
			
			$path = str_replace('_', '/', $class) . '.php';
			
			if ($class != 'Error' AND file_exists($path)) {
				include_once $path;
				$class::main($method, $id);
			}
			else {
				//self::showNotFound();
			}
		}
		
		public static function main($method, $id){}
	}
?>