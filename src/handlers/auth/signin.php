<?php

/**
 * Handles user login logic.
 * Validates credentials, starts session on success, and redirects to homepage.
 *
 * @package OnlineLibrary
 */
$pdo = getPDO();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $user = findUserByUsername($username);

    if (!$user || !password_verify($password, $user['password'])) {
        $errors[] = "Incorrect login or password!";
    }

    if (empty($errors)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'] ?? 'user';

        session_regenerate_id(true);

        logAction($_SESSION['username'], 'login');
        header('Location: /');
        exit;
    }
}
