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
$arNews = $news->GetList();
?>


<? foreach ($arNews as $item): ?>
    <article class="new">
        <h2><?= $item['title'] ?></h2>
        <p class="date"><?= $item['date'] ?></p>
        <div class="text"><?= $item['text'] ?></div>
        <p class="source"><?= $item['source'] ?></p>
    </article>
<? endforeach ?>
</body>
</html>