<?php

session_start();

$pdo = getPDO();
// Массив для хранения ошибок
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 1. Найти пользователя по имени (например, запрос к базе данных)
    $user = findUserByUsername($username);

    // 2. Проверить, существует ли пользователь
    // 3. Проверить хэш пароля
    if (!$user || !password_verify($password, $user['password'])) {
        $errors[] = "Неверный логин или пароль";
    }

    if (count($errors) == 0) {
        // 4. Если нет ошибок, сохранить данные пользователя в сессии:
        $_SESSION['user'] = [
            'id' => $user['id']
        ];

        // 5. Перенаправить пользователю на другую страницу
        header('Location: /');
        exit;
    }
}
