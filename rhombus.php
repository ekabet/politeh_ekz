<?php
	class Rhombus extends Polygon {
		protected $type = 'Ромб';
		protected function calcInfo() { 
			$this->perimetr = 4 * $this->sides['side1'];
			$this->area     = self::getSideLen($this->points['point1'], $this->points['point3']) * self::getSideLen($this->points['point2'], $this->points['point4']) / 2;
		}
	}
?>