<?php

session_start();
$pdo = getPDO();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = findUserByUsername($username);

    if (!$user || !password_verify($password, $user['password'])) {
        $errors[] = "Incorrect login or password!";
    }

    if (empty($errors)) {
        $_SESSION['user_id'] = $user['id'];
        session_regenerate_id();
        header('Location: /');
        exit;
    }
}
