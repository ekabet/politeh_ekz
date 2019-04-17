<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Publications
{
	public $connect = null;
	public $table = "";

	public function Connect()
	{
		$this->connect = mysqli_connect("localhost", "root", "", "oop");
		mysqli_query($this->connect,"SET NAMES 'utf8'");
		mysqli_query($this->connect,"SET CHARACTER SET 'utf8'");
		mysqli_query($this->connect,"SET SESSION collation_connection = 'utf8_general_ci'");
	}

	public function GetList()
	{
		$r = mysqli_query($this->connect,
				"SELECT * FROM {$this->table}");
		$result = [];
		while ($ar = mysqli_fetch_assoc($r)) {
			$result[] = $ar;
		}
		return $result;
	}

	/**
	 * Записывает в БД строку
	 * @param $arFields - хэш полей и значений, текстовые должны быть с кавычками
	 */
	public function SetRow($arFields) {
		$cols = implode("`,`",array_keys($arFields));
		$vals = implode(",",$arFields);
		$sql = "INSERT INTO `" . $this->table ."` (`"
			. $cols . "`) VALUES (" . $vals . ")";
		print_r($sql);
		mysqli_query($this->connect, $sql);
	}
}

final class News31 extends Publications
{
	private static $instance = null;


	private function __construct()
	{
		$this->Connect();
		$this->table = 'news31';
	}

	public static function GetInstance()
	{
		if (!(self::$instance instanceof self)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Добавляет новость, используя данные из $_REQUEST
	 */
	public function AddNew() {
		if (isset($_REQUEST['title']) &&
				isset($_REQUEST['date']) &&
				isset($_REQUEST['text']) &&
				isset($_REQUEST['source'])) {
			$arNew['title'] = "'".mysqli_real_escape_string(
					$this->connect, $_REQUEST['title'])."'";
			$arNew['date'] = "'".mysqli_real_escape_string(
					$this->connect, $_REQUEST['date'])."'";
			$arNew['text'] = "'".mysqli_real_escape_string(
					$this->connect, $_REQUEST['text'])."'";
			$arNew['source'] = "'".mysqli_real_escape_string(
					$this->connect, $_REQUEST['source'])."'";

			$this->SetRow($arNew);
		}
	}


	private function __clone()
	{
	}

	private function __sleep()
	{
	}

	private function __wakeup()
	{
	}
}

?>
