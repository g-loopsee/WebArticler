<?php
session_start();
require_once __DIR__ . '/../helpers.php';
require_once '../db_connect.php';

$article_id = $_POST['article_id'];

$connection = getMySql();

$name_result = $connection->query("SELECT name FROM articles WHERE id = '$article_id'");
$article_name = $name_result->fetch_assoc();
$result = $connection->query("DELETE FROM articles WHERE id = '$article_id'");

$json = array(
    'name' => $article_name['name'],
    'status' => $result
);

header('Content-Type: application/json');
$encoded_result = json_encode($json);

echo $encoded_result;