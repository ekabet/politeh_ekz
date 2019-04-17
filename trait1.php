<?
	class A {
		public $name = 'test';
	}
	
	$a = new A;
	$b = clone $a;
	$a->name = 'ssdfsd';
	print_r($a);
	print_r($b);

?>