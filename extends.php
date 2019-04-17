<?
	class Square {
		private   $a;
		protected $p;
		protected $s;
		
		function getAngle() {
			echo 'Все углы по 90 градусов';
		}
		
		function calcP() {
			$this->p = $this->a * 4;
		}
		
		function calcS() {
			$this->s = $this->a ** 2;
		}
		function setA($a) {
			$this->a = $a;
		}
	}
	
	class Poligon extends Square {
		public $b;
		function calcP() {
			$this->p = ($this->a + $this->b) * 2;
		}
		
		function calcS() {
			parent::calcS();
			$this->s = sqrt($this->s) * $this->b;
		}
	}
	
	//$square = new Square;
	//$square->a = 10;
	//$square->calcP();
	//$square->calcS();
	//echo '<pre>';
	//print_r($square);
	//echo '</pre>';
	$poligon = new Poligon;
	$poligon->setA(10);
	//$poligon->a = 10;
	//$poligon->b = 5;
	//$poligon->calcP();
	//$poligon->calcS();
	echo '<pre>';
	print_r($poligon);
	//echo '</pre>';