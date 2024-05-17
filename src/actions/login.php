<?php
session_start();
require_once   '../helpers.php';
require_once '../db_connect.php';
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

addOldValue('login', $login);

if (empty($login)){
    addValidationError('login', 'Логин не может быть пустым');
    setMessage('error', 'Ошибка валидации');
    redirect('/');
}

$user = findUser($login);

if (!$user){
    setMessage('error', "Пользователь $login не найден!");
    redirect('/');
}

if (!($password == $user['password'])){
    setMessage('error', "Неверный пароль!");
    redirect('/');
}

$_SESSION['user']['id'] = $user['id'];

redirect('/menu.php');