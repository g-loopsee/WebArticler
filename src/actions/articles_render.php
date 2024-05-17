<?php
require_once '../helpers.php';

$articles = getAllArticles();

$array = array();
while($row = mysqli_fetch_assoc($articles)){
    $array[] = $row;
}


$result = json_encode($array);


echo $result;
function getAllArticles(){
    $connection = getMySql();
    return $connection->query("SELECT * FROM articles");
}