<?php
	abstract class Polygon {
		public $points = array();
		protected $type, $area, $perimetr, $sides = array(), $name;
		protected function __construct($points, $name) {
			$this->points = $points;
			$this->name   = $name;
			$this->sides['side1'] = self::getSideLen($this->points['point1'], $this->points['point2']);
			$this->sides['side2'] = self::getSideLen($this->points['point2'], $this->points['point3']);
			$this->sides['side3'] = self::getSideLen($this->points['point3'], $this->points['point4']);
			$this->sides['side4'] = self::getSideLen($this->points['point4'], $this->points['point1']);
			$this->calcInfo();
		}
		public function __destruct() {
			//unlink("{$this->name}.png");
		}
		public function scale() { }
		protected function draw() {
			$side     = floor(max(self::getSideLen($this->points['point1'], $this->points['point3']), self::getSideLen($this->points['point2'], $this->points['point4'])) + 10);
			$center[] = ($this->points['point1'][0] + $this->points['point3'][0]) / 2;
			$center[] = ($this->points['point1'][1] + $this->points['point3'][1]) / 2;
			$width    = $side + (abs($center[0]) * 2);
			$height   = $side + (abs($center[1]) * 2);
			$img      = imagecreate($width, $height);
			$white    = imagecolorallocate($img, 255, 255, 255);
			$black    = imagecolorallocate($img, 0, 0, 0);
			
			foreach($this->points as $point => $list) {
				$arr[] = $list[0] + floor($width / 2);
				$arr[] = $list[1] + floor($height / 2);
			}
			imageline($img, floor($width / 2), floor($height / 2), 1000, floor($height / 2), $black);
			imageline($img, floor($width / 2), floor($height / 2), floor($width / 2), 1000, $black);
			imagepolygon($img, $arr, 4, $black);
			imageflip($img, IMG_FLIP_VERTICAL);
			imagepng($img, $this->name . '.png');
		}
		public function move() { }
		public function save() {
			$points = serialize($this->points);
			$db = mysqli_connect('localhost', 'root', '', 'geometry');
			mysqli_query($db, "
				INSERT INTO `figuries` (`name`, `points`)
				VALUE ('{$this->name}', '$points');
			");
		}
		public function showInfo() {
			$this->getName();
			$this->draw();
			echo "<tr>";
			echo "<td>{$this->type}</td>";
			echo "<td>
				x<sub>1</sub>: {$this->points['point1'][0]}, y<sub>1</sub>: {$this->points['point1'][1]}<br/>
				x<sub>2</sub>: {$this->points['point2'][0]}, y<sub>2</sub>: {$this->points['point2'][1]}<br/>
				x<sub>3</sub>: {$this->points['point3'][0]}, y<sub>3</sub>: {$this->points['point3'][1]}<br/>
				x<sub>4</sub>: {$this->points['point4'][0]}, y<sub>4</sub>: {$this->points['point4'][1]}<br/>
			</td>";
			echo "<td>{$this->perimetr}</td>";
			echo "<td>{$this->area}</td>";
			echo "<td><img src='{$this->name}.png' width='100%' /></td>";
			echo "</tr>";
		}
		protected static function getSideLen($point1, $point2) {
			return sqrt(pow($point2[0] - $point1[0], 2) + pow($point2[1] - $point1[1], 2));
		}
		protected function getName() {
			if (!$this->name) {
				for ($i = 0; $i < 10; $i++) {
					$this->name.= rand(0, 9);
				}
			}
		}
		static function checkFigure($points, $name = '') {
			if (self::getSideLen($points['point2'], $points['point4']) == self::getSideLen($points['point1'], $points['point3']) AND 
				self::getSideLen($points['point1'], $points['point2']) == self::getSideLen($points['point2'], $points['point3'])) {
				return new Square($points, $name);
			}
			else if (self::getSideLen($points['point2'], $points['point4']) != self::getSideLen($points['point1'], $points['point3']) AND 
				self::getSideLen($points['point1'], $points['point2']) == self::getSideLen($points['point2'], $points['point3']) AND
				self::getSideLen($points['point2'], $points['point3']) == self::getSideLen($points['point3'], $points['point4']) AND
				self::getSideLen($points['point3'], $points['point4']) == self::getSideLen($points['point4'], $points['point1'])) {
				return new Rhombus($points, $name);
			}
			else if (self::getSideLen($points['point2'], $points['point4']) == self::getSideLen($points['point1'], $points['point3']) AND self::getSideLen($points['point1'], $points['point2']) != self::getSideLen($points['point2'], $points['point3'])) {
				return new Rectangle($points, $name);
			}
			else {
				return null;
			}
		}
		abstract protected function calcInfo();
	}
?>
	