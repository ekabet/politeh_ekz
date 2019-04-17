<form method="post">
	<input type="text" name="login"><br>
	<input type="password" name="pass"><br>
	<input type="submit">
</form>
<?php
if (isset($_POST['login'])) {

	require_once 'err.php';
	require_once 'db.php';
	require_once 'user.php';
	
	
	DB::connect('localhost', 'root', '', 'oop');
	$obj = User::signIn($_POST['login'], $_POST['pass']);
	print_r($obj);
}
?>