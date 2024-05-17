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
    <link rel="stylesheet" href="assets/home.css">
    <script src="assets/jquery-3.7.1.min.js"></script>
    <script src="src/scripts/home.js"></script>
</head>
<body>

<div class="top-bar">
    <form action="/menu.php" method="get" class="top-form">
        <button type="submit" class="top-button">Меню</button>
    </form>
    <form action="/add_article_form.php" method="post" class="top-form">
        <button type="submit" class="top-button">Добавить статью</button>
    </form>
    <form id="fast-button" class="top-form">
        <button type="submit" class="top-button">Быстрое добавление</button>
    </form>

    <div class="welcome_message">
        Привет, <?=$user['name']?>!
    </div>

    <form action="/src/actions/logout.php" method="post" class="top-form logout-form">
        <button type="submit" class="top-button">Выход</button>
    </form>
</div>

<div class="middle-bar">
    <form action="" id="fast-add-form">
        <label for="article_name">Название</label>
        <input type="text" name="article_name" id="article_name">
        <input type="hidden" name="article_author" id="article_author" value="<?=currentUser()['name']?>">
        <label for="article_content">Содержание</label>
        <textarea name="article_content" id="article_content" cols="15" rows="5"></textarea>
        <input type="submit" value="Добавить">
    </form>
</div>


<table class="article-table">
    <tr>
        <td>
            Название
        </td>
        <td>
            Автор
        </td>
        <?php if (isAdmin(currentUser())){
            echo '<td></td>';
        } ?>

    </tr>
    <?php
    $result = $connection->query("SELECT * from users");
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $result = $connection->query("SELECT * from articles", MYSQLI_USE_RESULT);
    while ($row = $result->fetch_assoc()) {
        echo '<tr id="main_tr">';
            echo '<td>';
            ?>

            <form action="article_page.php" method="post" style="padding: 0; margin: 0">
                <input type="hidden" name="article_id" value="<?=$row['id']?>">
                <input type="hidden" name="article_name" value="<?=$row['name']?>">
                <input type="submit" value="<?=$row['name']?>" style="color:hsl(205, 20%, 32%); background-color: white; border: none; margin: 0; padding: 0">
            </form>

            <?php

            echo '</td>';

            $user_id = $row['author'];
            $user_name = '';
            foreach ($users as $user){
                if ($user['id'] == $row['author']){
                    $user_name = $user['name'];
                }
            }
            echo '<td>';
                echo $user_name;
            echo '</td>';
            if (isAdmin(currentUser())){
                ?>
                <td>
                    <form id="delete-form" style="margin-top: 15%; margin: 0">
                        <input type="hidden" name="article_id" value="<?=$row['id']?>">
                        <input type="submit" value="Удалить" id="delete-article">
                    </form>
                </td>

            <?php
            }
        if (false){
            ?>
            <td>
                <form action="src/actions/delete_article.php" method="post" style="margin-top: 15%; margin: 0">
                    <input type="hidden" name="article_id" value="<?=$row['id']?>">
                    <input type="submit" value="Удалить" id="delete-article">
                </form>
            </td>

            <?php
        }

        echo '</tr>';
    print(mysqli_error($connection));
    }
    ?>
</table>
</body>
</html>