<?php
require_once '../helpers.php';

$user_id = $_POST['user_id'];
$user = getUserNameById($user_id)->fetch_assoc();

function getUserNameById($id){
    $connection = getMySql();
    $stmt = $connection->prepare("SELECT * FROM users where id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

echo $user['name'];