<form>
	<table>
		<tr>
			<th>X</th>
			<th>Y</th>
		</tr>
		<tr>
			<th><input type="text" name="point1[0]"></th>
			<th><input type="text" name="point1[1]"></th>
		</tr>
		<tr>
			<th><input type="text" name="point2[0]"></th>
			<th><input type="text" name="point2[1]"></th>
		</tr>
		<tr>
			<th><input type="text" name="point3[0]"></th>
			<th><input type="text" name="point3[1]"></th>
		</tr>
				<tr>
			<th><input type="text" name="point4[0]"></th>
			<th><input type="text" name="point4[1]"></th>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Рисовать"></td>
		</tr>
	</table>
</form>
<?php
	if (!empty($_GET) && $_GET['point1'][0] != '') {
		$figure = Polygon::checkFigure($_GET);
		echo '<table border = 1>';
		echo '<tr><th>Тип</th><th>Координаты</th><th>Периметр</th><th>Площадь</th><th>Изображение</th></tr>';
		if ($figure !== null) {
			$figure->showInfo();
			$figure->save();
		}
		else {
			echo '<tr><td colspan="5">Некорректная фигура!</td></tr>';
		}
		echo '</table>';
	}
	function __autoload($class) {
		include_once "$class.php";
	}
?>