<?php

session_start();

$pdo = getPDO();
$errors = [];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($password) || empty($username)) {
    $errors[] = "Все поля обязательны для заполнения.";
}

if (userExists($username)) {
    $errors[] = "Пользователь с таким логином уже существует.";
}

if (empty($errors)) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    createUser($username, $passwordHash);
    addRoleToUser();

    header('Location: /');

    exit;
}
