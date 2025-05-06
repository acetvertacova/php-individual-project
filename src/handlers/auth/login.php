<?php

/**
 * Handles user registration logic.
 * Validates input, checks for existing username, creates a new user, and assigns a default role.
 *
 * @package OnlineLibrary
 */

$pdo = getPDO();
$errors = [];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($password) || empty($username)) {
        $errors[] = "All fields are required.";
    }

    if (userExists($username)) {
        $errors[] = "Username is taken.";
    }

    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        createUser($username, $passwordHash);
        addRoleToUser();

        header('Location: /');
        exit;
    }
}
