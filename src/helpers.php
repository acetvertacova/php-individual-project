<?php

function getAll(): array
{
    global $pdo;
    $sql = "SELECT title, author, genre, available, description FROM book";

    $stmt = $pdo->query($sql);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $books;
}

function getLastFiveBooks(): array
{
    global $pdo;
    $sql = "SELECT * FROM book ORDER BY created_at DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $latestBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $latestBooks;
}

function filter(string $criteria, string $value): array
{
    global $pdo;
    $allowed = ['title', 'author', 'genre'];

    if (!in_array($criteria, $allowed)) {
        echo "Not allowed criteria of search";
    }

    $sql = "SELECT * FROM book WHERE $criteria ILIKE :value";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['value' => "%$value%"]);

    $books = $stmt->fetchAll();
    return $books;
}

function userExists(string $username): bool
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);

    return (bool) $stmt->fetchColumn();
}

function createUser(string $username, string $passwordHash)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $passwordHash]);
}

function addRoleToUser()
{
    global $pdo;
    $userId = $pdo->lastInsertId();
    $stmt = $pdo->prepare("SELECT id FROM role WHERE name = ?");
    $stmt->execute(['user']);
    $roleId = $stmt->fetchColumn();

    if ($roleId) {
        $stmt = $pdo->prepare("INSERT INTO users_role (user_id, role_id) VALUES (?, ?)");
        $stmt->execute([$userId, $roleId]);
    }
}

function findUserByUsername(string $username, $columns = ['*'])
{
    global $pdo;
    $selectFields = implode(',', $columns);
    $stmt = $pdo->prepare("SELECT {$selectFields} FROM users WHERE username = ?");
    $stmt->execute([$username]);

    return $stmt->fetch();
}
