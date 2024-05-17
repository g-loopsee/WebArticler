<?php
session_start();
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../db_connect.php';

checkGuest();



$name = $_POST['name'];
$login = $_POST['login'];
$password = $_POST['password'];
$passwordConfirmation = $_POST['password_confirmation'];

$_SESSION['validation'] = [];



if(empty($name)){
    addValidationError('name', 'Неверное имя');
}

if(empty($login)){
    addValidationError('login', 'Неверный логин');
}

if(empty($password)){
    addValidationError('password', 'Пароль некорректный');
}

if (!($password == $passwordConfirmation))
{
    addValidationError('password_confirmation', 'Пароли не совпадают');
}

if (!empty($_SESSION['validation'])){
    addOldValue("name", $name);
    addOldValue("login", $login);
    redirect("/register_form.php");
}

$des = getMySql();

$addUser = mysqli_query($des, "INSERT INTO users (name, login, password, role) VALUES ('$name', '$login', '$password', 'user')");

header('Location: /index.php');