
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === 'Danil9021612!') {
        $_SESSION['auth'] = true;
        header('Location: editor.php');
        exit;
    } else {
        $error = "Неверный пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="window">
    <div class="title-bar"><div class="title-bar-text">Вход</div></div>
    <div class="window-body">
        <form method="POST">
            <label>Пароль:<br><input type="password" name="password"></label><br><br>
            <button type="submit">Войти</button>
            <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        </form>
    </div>
</div>
</body>
</html>
