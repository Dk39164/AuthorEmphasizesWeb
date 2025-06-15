
<?php
include("Parsedown.php");

$file = basename($_GET['file']);
$filepath = "posts/$file.md";
$datefile = "posts/$file.date.txt";

if (!file_exists($filepath)) {
    die("Файл не найден.");
}

$content = file_get_contents($filepath);
$date = file_exists($datefile) ? file_get_contents($datefile) : "Дата неизвестна";

$Parsedown = new Parsedown();
$parsedContent = $Parsedown->text($content);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $file ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="window">
    <div class="title-bar"><div class="title-bar-text"><?= $file ?></div></div>
    <div class="window-body">
        <small>📅 <?= $date ?></small>
        <hr>
        <?= $parsedContent ?>
        <hr>
        <a href="index.php">← Назад</a>
    </div>
</div>
</body>
</html>
