<?php
	class Rectangle extends Polygon {
		protected $type = 'Прямоугольник';
		protected function calcInfo() { 
			$this->perimetr = 2 * ($this->sides['side1'] + $this->sides['side2']);
			$this->area     = $this->sides['side1'] * $this->sides['side2'];
		}
	}
?>