
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Author Emphasizes</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="window">
    <div class="title-bar">
        <div class="title-bar-text">Мой Техноблог</div>
    </div>
    <div class="window-body">
        <img src="img/avatar.png" class="avatar">
        <h1>Author Emphasizes</h1>
        <p><em>ERROR 404</em></p>
        <hr>
        <div>Вы — посетитель № <?= str_pad(\$counter, 6, '0', STR_PAD_LEFT) ?></div>
        <?php
$counterFile = 'counter.txt';
if (!file_exists($counterFile)) file_put_contents($counterFile, 0);
$counter = (int)file_get_contents($counterFile) + 1;
file_put_contents($counterFile, $counter);

            $posts = glob("posts/*.md");
            usort($posts, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });
            foreach ($posts as $post) {
                $title = basename($post, ".md");
                echo "<div class='post'><a href='view.php?file=$title'>$title</a></div>";
            }
        ?>
        <hr>
        <a href="admin/login.php">✍ Вход для администратора</a>
    </div>
</div>
</body>
</html>
