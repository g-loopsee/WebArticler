<?php
session_start();
require_once __DIR__ . '/../helpers.php';
require_once '../db_connect.php';

$name = $_POST['name'];
$content = $_POST['content'];

$user = currentUser();
$user_id = $user['id'];

addOldValue('name', $name);
addOldValue('content', $content);

if (empty($name)){
    addValidationError('name', 'Название не может быть пустым');
    redirect('/add_article_form.php');
}

if (empty($content)){
    addValidationError('content', 'Содержание не может быть пустым');
    redirect('/add_article_form.php');
}

$connection = getMySql();

$result = $connection->query("INSERT INTO articles (name, content, author) VALUES ('$name', '$content', '$user_id')");


$array = array(
    'user_id' => $user_id,
    'name' => $name,
    'content' => $content,
    'status' => $result
);

$json = json_encode($array);


echo $json;


