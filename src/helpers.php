<?php
session_start();
require_once __DIR__ . '/db_connect.php';
function redirect(string $path)
{
    header("Location: $path");
    die();
}

function maybeHasError(string $fieldName)
{
    echo isset($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function getErrorMessage(string $fieldName)
{
    $mes = $_SESSION['validation'][$fieldName] ?? '';
    unset($_SESSION['validation'][$fieldName]);
    echo $mes;
}

function addValidationError(string $fieldName, string $message)
{
    $_SESSION['validation'][$fieldName] = $message;
}

function clearValidation()
{
    $_SESSION['validation'] = [];
}

function addOldValue($key, $value): void
{
    $_SESSION['old'][$key] = $value;
}

function getOldValue(string $key)
{
    $val = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $val;
}

function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

function getMessageError(string $key): string
{
    $mes = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $mes;
}

function findUser(string $login)
{
    $connection = getMySql();
    $result = $connection->query("SELECT * from users WHERE login = '$login'");

    return $result->fetch_assoc();


}

function currentUser()
{
    if (!isset($_SESSION['user'])) {
        return false;
    }
    $connection = getMySql();
    $id = $_SESSION['user']['id'];
    $result = $connection->query("SELECT * from users WHERE id = '$id'");
    return $result->fetch_assoc();
}

function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/index.php');
}

function checkAuth()
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('/');
    }
}

function checkGuest()
{
    if (isset($_SESSION['user']['id'])) {
        redirect('/home.php');
    }
}

function isAdmin($user): bool
{
    if ($user['role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function getRandomArticle(): int
{
    $connection = getMySql();
    $result = $connection->query("SELECT * FROM articles ORDER BY RAND() LIMIT 0, 1;");

    $article = $result->fetch_assoc();

    return $article['id'];
}

