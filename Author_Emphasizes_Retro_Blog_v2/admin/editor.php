
<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_POST['title']);
    $content = $_POST['content'];
    file_put_contents("../posts/$title.md", $content);
    file_put_contents("../posts/$title.date.txt", date('d.m.Y H:i'));
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новый пост</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="window">
    <div class="title-bar"><div class="title-bar-text">Новый пост</div></div>
    <div class="window-body">
        <form method="POST">
            <label>Заголовок:<br><input type="text" name="title" required></label><br><br>
            <label>Содержимое:<br><textarea name="content" rows="10" cols="60"></textarea></label><br><br>
            <button type="submit">Сохранить</button>
        </form>
        <br><a href="export.php">📦 Экспортировать все посты (ZIP)</a><hr>
        <a href="../index.php">← Назад</a>
    </div>
</div>
</body>
</html>
