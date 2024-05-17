<?php
session_start();
require_once __DIR__ . '/src/helpers.php';


?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Новая статья</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body class="auth_body">

<form class="card" action="src/actions/add_article.php" method="post">
    <h2>Новая статья</h2>

    <?php if (hasMessage('error')): ?>
        <div class="notice error"><?php echo getMessageError('error') ?></div>
    <?php endif;?>

    <label for="name">
        Название статьи
        <input type="text" id="name" name="name" placeholder="article_name"
               value="<?php echo getOldValue('name')?>"
            <?php maybeHasError('name'); ?>
        >
        <small><?php getErrorMessage('name'); ?></small>
    </label>

    <label for="content">
        Содержание
        <textarea name="content" id="content" cols="30" rows="10"><?php echo getOldValue('content')?></textarea>
        <small><?php getErrorMessage('content'); ?></small>
    </label>

    <button type="submit" id="submit">Добавить</button>
</form>


<script src="assets/app.js"></script>
</body>
</html>