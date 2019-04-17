<?
	interface People {
		public function sayHello();
		public function sayGoodBy();
	}
	
	abstract class User implements People {
		protected $_company;
		
		public function sayHello() {
			echo 'Hello ' . $this->_company;
		}
		
		abstract public function sayGoodBy();
	}
	
	class Client extends User {
		public function setCompany($company) {
			$this->_company = $company;
		}
		
		public function sayGoodBy() {
			echo 'GoodBy!';
		}
		
		//public function sayHello() {
		//	echo "из компании '{$this->_company}'\n";
		//}
    
	}
	
	//$user = new User('Ivan');
	//$user->sayHello();
	
	$client = new Client('Petr');
	$client->setCompany('РиК');
	$client->sayHello();
	
	echo '<pre>';
	print_r($client);
	
	if($client instanceof People) {
		$client->sayGoodBy();
	}
?>