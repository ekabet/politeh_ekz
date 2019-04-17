<?php
	function __autoload($class) {
		include_once "$class.php";
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'geometry');
	$q = mysqli_query($db, "SELECT `name`, `points` FROM `figuries`;");
	$arrFigures = array();
	
	while($figure = mysqli_fetch_assoc($q)) {
		$arrFigures[] = Polygon::checkFigure(unserialize($figure['points']), $figure['name']);
	}
	
	echo '<table border = 1>';
	echo '<tr><th>Тип</th><th>Координаты</th><th>Периметр</th><th>Площадь</th><th>Изображение</th></tr>';
	foreach($arrFigures as $figure) {
		if ($figure !== null) {
			$figure->showInfo();
		}
		else {
			echo '<tr><td colspan="5">Некорректная фигура!</td></tr>';
		}
	}
	echo '</table>';
?>