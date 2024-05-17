<?php
session_start();
require_once __DIR__ . '/src/helpers.php';
require_once 'src/db_connect.php';

checkAuth();
$article_id = $_POST['article_id'];

$connection = getMySql();

$result = $connection->query("SELECT * FROM articles WHERE id = '$article_id'");

$article = $result->fetch_assoc();

$url = $_SERVER['HTTP_REFERER'];

$from = substr($url, 21);
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title><?=$article['name']?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body class="auth_body">
<form class="card" action="<?= $from ?>">
    <h2><?=$article['name']?></h2>

    <label for="content">
        Содержание
        <p><?=$article['content']?></p>
    </label>
    <button type="submit" id="submit">Назад</button>
</form>


<script src="assets/app.js"></script>
</body>
</html>