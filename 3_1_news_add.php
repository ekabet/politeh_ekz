<?php include_once("3_1.php");?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?
$news = News31::GetInstance();
$news->AddNew();
?>

<form action="" method="post">
    <input type="hidden" action="addNew">
    <input type="text" name="title" placeholder="Заголовок"><br>
    <input type="date" name="date" placeholder="Дата"><br>
    <textarea name="text" placeholder="Текст новости"></textarea><br>
    <input type="text" name="source" placeholder="Источник"><br>
    <input type="submit">
</form>


</body>
</html>