<?php
session_start();
require_once __DIR__ . '/src/helpers.php';
require_once 'src/db_connect.php';
checkAuth();

$user = currentUser();
$connection = getMySql();

?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/menu.css">
</head>
<body>


<div class="top-bar">
    <form action="/home.php" method="post" class="top-form">
        <button type="submit" class="top-button">Все статьи</button>
    </form>

    <form action="/article_page.php" method="post" class="top-form">
        <input type="hidden" value="<?=getRandomArticle();?>" name="article_id">
        <button type="submit" class="top-button">Случайная статья</button>
    </form>

    <form action="/src/actions/logout.php" method="post" class="top-form logout-form">
        <button type="submit" class="top-button">Выход</button>
    </form>
</div>


<script src="assets/app.js"></script>
</body>
</html>