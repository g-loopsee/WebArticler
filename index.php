<?php
session_start();
require_once __DIR__ . '/src/helpers.php';

checkGuest();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body class="auth_body">

<form class="card" action="src/actions/login.php" method="post">
    <h2>Вход</h2>

    <?php if (hasMessage('error')): ?>
        <div class="notice error"><?php echo getMessageError('error') ?></div>
    <?php endif;?>

    <label for="login">
        Логин
        <input type="text" id="login" name="login" placeholder="ivanov_ivan"
               value="<?php echo getOldValue('login')?>"
            <?php maybeHasError('login'); ?>
        >
        <small><?php getErrorMessage('login'); ?></small>
    </label>

    <label for="password">
        Пароль
        <input type="password" id="password" name="password" placeholder="******">
    </label>

    <button type="submit" id="submit">Продолжить</button>
</form>

<p>У меня еще нет <a href="/register_form.php">аккаунта</a></p>

<script src="assets/app.js"></script>
</body>
</html>