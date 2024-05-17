<?php
function getMySql():mysqli{
    $des = mysqli_connect("localhost", "root", "", "articler");
    if ($des == false){
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    mysqli_set_charset($des, "utf8");

    return $des;
}