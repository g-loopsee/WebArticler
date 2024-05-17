<?php
session_start();
require_once __DIR__ . '/src/helpers.php';

?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <link rel="stylesheet" href="assets/app.css">
</head>
<body class="auth_body">

<form class="card" action="src/actions/register.php" method="post">
    <h2>Регистрация</h2>

    <label for="name">
        Имя
        <input type="text" id="name" name="name" placeholder="Иванов Иван"
               value="<?php echo getOldValue('name') ?>"
            <?php maybeHasError('name'); ?>
        >
        <small><?php getErrorMessage('name'); ?></small>
    </label>

    <label for="login">
        Login
        <input type="text" id="login" name="login" placeholder="ivan_ivanov"
               value="<?php echo getOldValue('l ogin') ?>"
            <?php maybeHasError('login'); ?>
        >
        <small><?php getErrorMessage('login'); ?></small>
    </label>


    <div class="grid">
        <label for="password">
            Пароль
            <input type="password" id="password" name="password" placeholder="******"
                <?php maybeHasError('password'); ?>
            >
            <small><?php getErrorMessage('password'); ?></small>
        </label>

        <label for="password_confirmation">
            Подтверждение
            <input type="password" id="password_confirmation"
                   name="password_confirmation" placeholder="******"
                <?php maybeHasError('password_confirmation'); ?>>
            <small><?php getErrorMessage('password_confirmation'); ?></small>
        </label>
    </div>

    <button type="submit" id="submit">Продолжить</button>
</form>

<?php clearValidation(); ?>

<p>У меня уже есть <a href="/index.php">аккаунт</a></p>

<script src="assets/app.js"></script>
</body>
</html>