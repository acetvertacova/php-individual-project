<?php

session_start();
$pdo = getPDO();

if (!can('create_user')) {
    header("Location: /403");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($username) && isset($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        createUser($username, $passwordHash);
        addRoleToUser();
        header("Location: /users");
        exit;
    }
}
